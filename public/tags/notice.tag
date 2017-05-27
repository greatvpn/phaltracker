<notice>
    <div class="col-md-12">
        <div class="box box-primary nav-tabs-custom">
            <div class="box-header with-border">
                <i class="ion ion-clipboard"></i>

                <h3 class="box-title">公告栏</h3>

                <div class="box-tools pull-right">
                    <ul class="pagination pagination-sm inline">
                        <li><a href="#news1" data-toggle="tab">&laquo;</a></li>
                        <li class="{item.active}" each={item,key in opts.data}><a href="#news{key+1}" data-toggle="tab"
                                                                                  aria-expanded="false">{key+1}</a></li>
                        <li><a href="#news{opts.data.length}" data-toggle="tab">&raquo;</a></li>
                    </ul>
                </div>
            </div>
            <!-- /.box-header -->
            <div class="box-body tab-content">
                <div class="tab-pane {item.active}" id="news{key+1}" each={item,key in opts.data}>
                    <h2>{item.title}</h2>
                    <div class="tools" if={ can_edit }><a href="/notice/edit/{item.id}"><i
                            class="fa fa-edit"></i></a>
                        <a href="/notice/delete/{item.id}"><i class="fa fa-trash-o"></i></a>
                    </div>
                    <p>{item.body}</p>
                </div>
            </div>
            <!-- /.box-body -->
            <div class="box-footer clearfix no-border">
                <button type="button" class="btn btn-default pull-right"><i class="fa fa-plus"></i> Add item
                </button>
            </div>
        </div>
    </div>
    <script>
        this.can_edit = opts.can_edit
    </script>
</notice>