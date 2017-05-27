<script>
    var stdhead_data = {
        logo_mini: 'TJUPT',
        logo_large: '北洋园PT',
        user_info: {{ current_user }},
        messages: {
            count: 8,
            detail: []
        }
    };
    var navigation = [
        {
            title: '首页',
            url: '#',
        },
        {
            title: '论坛',
            url: '#',
        },
        {
            title: '种子',
            url: '#',
            children: [
                {sub_title: '电影', sub_url: '#'},
                {sub_title: '剧集', sub_url: '#'},
                {sub_title: '游戏', sub_url: '#'},
                {sub_title: '动漫', sub_url: '#'}
            ]
        },
        {
            title: '候选',
            url: '#',
        },
        {
            title: '求种',
            url: '#',
        },
        {
            title: '规则',
            url: '#',
        },
    ];
</script>
<script src="https://cdn.jsdelivr.net/riot/3.2/riot+compiler.min.js"></script>
<script>riot.mount('stdhead', stdhead_data)</script>
<script>riot.mount('sidebar', {stdhead_data:stdhead_data,navigation:navigation})</script>
<script>riot.mount('stdfoot')</script>
<script>riot.mount('control-sidebar')</script>