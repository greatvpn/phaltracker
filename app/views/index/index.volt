<div class="wrapper">
    <stdhead></stdhead>
    <sidebar></sidebar>
    <div class="content-wrapper">
        <content-header></content-header>
        <section class="content">
            <div class="col-md-8">
                <notice></notice>
                <chatbox></chatbox>
                <funbox></funbox>
            </div>
            <div class="col-md-4">
                <vote></vote>
                <recommend_torrents></recommend_torrents>
            </div>
        </section>
    </div>
    <stdfoot></stdfoot>
    <control-sidebar></control-sidebar>
    <div class="control-sidebar-bg"></div>

</div>
<!-- include the tag -->
{{ partial("partials/tags") }}
<script type="riot/tag" src="tags/content-header.tag"></script>
<script type="riot/tag" src="tags/notice.tag?s=233"></script>
<script type="riot/tag" src="tags/chatbox.tag?t=5"></script>
<script type="riot/tag" src="tags/recommend_torrents.tag?t=5"></script>
<script type="riot/tag" src="tags/funbox.tag?t=5"></script>
<script type="riot/tag" src="tags/vote.tag?t=5"></script>
<!-- mount the tag -->
{{ partial("partials/riot") }}
<script>var content_header_data = {
    title: '首页',
    description: ''
};

var notice_data = {
    can_edit:1,
    data: {{news}}
};
var shoutbox = {
    data: {{shoutbox}}
};
</script>
<script>riot.mount('content-header', content_header_data)</script>
<script>riot.mount('notice', notice_data)</script>
<script>riot.mount('chatbox', shoutbox)</script>
<script>riot.mount('recommend_torrents')</script>
<script>riot.mount('funbox')</script>
<script>riot.mount('vote')</script>