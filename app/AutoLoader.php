<?php
/**
 * Created by PhpStorm.
 * User: scaryken
 * Date: 2017/4/25
 * Time: 23:07
 */

class AutoLoader
{

    const REGISTER_NAMESPACE = 1;

    const NO_REGISTER_NAMESPACE = 0;

    static $_CLASSEXTENSIONS=['php'];

    static $_DEFAULT_LOADDIRS=[
        'components' => self::REGISTER_NAMESPACE,
        'controllers' => self::REGISTER_NAMESPACE,
    ];

    private $currentDir;
    private $loadDirArray;
    private $classPathArray;
    private $root_dir;
    public function __construct($root_dir) {
        if(empty($root_dir)){
            die ('autoload no config root_dir');
        }
        $this->root_dir=$root_dir;
        // 需要自动加载的二级目录
        $this->loadDirArray =self::$_DEFAULT_LOADDIRS;
        $this->classPathArray = array ();
    }
    public function registerAutoLoadPath(){
        $loader = new \Phalcon\Loader ();
        $loader->setExtensions(self::$_CLASSEXTENSIONS);
        $pathArray = $this->getClassPathArray ();
        $loader->registerClasses ( $pathArray, true );
        $loader->register ();

    }
    private function getClassPathArray() {
        foreach ( $this->loadDirArray as $dir => $isRegisterNamespace ) {
            $this->currentDir = $this->root_dir . $dir;
            $this->traversClassPath ( $this->currentDir,$isRegisterNamespace );
        }
        return $this->classPathArray;
    }
    private function traversClassPath($path, $isRegisterNamespace, $expandedName = 'php') {
        $current_dir = opendir ( $path );
        while (true) {
            $file = readdir ( $current_dir );
            if(empty($file)){
                break;
            }
            $sub_dir = $path . '/' . $file;
            if ($file == '.' || $file == '..') {
                continue;
            } else if (is_dir ( $sub_dir )) {
                $this->traversClassPath ( $sub_dir, $isRegisterNamespace );
            } else {
                $temArray = explode ( '.', $file );
                if(in_array($temArray[count($temArray)-1],self::$_CLASSEXTENSIONS)){
                    $fileName = $temArray [0];
                    $className = '';
                    if ($isRegisterNamespace) {
                        $classNamePrefix = substr ( $path, strlen ( $this->currentDir ) + 1 );
                        $className = empty ( $classNamePrefix ) ? $fileName : str_replace ( '/', '\\', $classNamePrefix ) . '\\' . $fileName;
                    } else {
                        $className = $fileName;
                    }
                    if (isset ( $temArray [1] ) && $temArray [1] == $expandedName) {
                        $this->classPathArray [$className] = $path . '/' . $file;
                    }
                }
            }
        }
        closedir($current_dir);
    }
}