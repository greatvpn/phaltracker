<div class="wrapper">
    <stdhead></stdhead>
    <sidebar></sidebar>
    <div class="content-wrapper">
        <content-header></content-header>
        <section class="content">

        </section>
    </div>
    <stdfoot></stdfoot>
    <control-sidebar></control-sidebar>
    <div class="control-sidebar-bg"></div>

</div>

<!-- include the tag -->
{{ partial("partials/tags") }}
<script type="riot/tag" src="tags/content-header.tag"></script>

{{ partial("partials/riot") }}
<script>var content_header_data={
    title:'种子',
    description:''
};</script>
<script>riot.mount('content-header',content_header_data)</script>