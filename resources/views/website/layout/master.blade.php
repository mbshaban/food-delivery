<!DOCTYPE html>
<html class="loading" lang="en" data-textdirection="rtl">


@include('website/include/head')
<body class="vertical-layout vertical-content-menu 2-columns menu-expanded fixed-navbar" data-open="click"
      data-menu="vertical-content-menu" data-col="2-columns">

@include('website/include/header')

<div class="app-content content">
    <div class="content-wrapper">
        <div class="content-header row">
        </div>
        @include('website/include/sidebar')
        <div class="content-body"><!-- Analytics charts -->
        </div>
    </div>
</div>


@include('website/include/footer')
@include('website/include/script')
</body>

</html>
