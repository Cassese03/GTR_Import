
<?php if (substr($page, 0, 1) != 'c'){ ?>
@include("admin.common.header")
@include("admin.common.sidebar")
<div class="content-wrapper" style="min-height: 80vh">
    @include("admin.content.$page")
</div>
    <?php if ($page != 'cliente.login'){ ?>
@include("admin.common.footer")
<?php } ?>
<?php } ?>

<?php if (substr($page, 0, 1) == 'c'){ ?>
@include("admin.content.cliente.common.header")
<div class="content-wrapper" style="min-height: 80vh">
    @include("admin.content.$page")
</div>
    <?php if ($page != 'cliente.login'){ ?>
@include("admin.content.cliente.common.footer")
<?php } ?>
<?php } ?>
