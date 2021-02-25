<!DOCTYPE html>
<html class="loading" lang="en" data-textdirection="rtl">



@include('dashboard/include/head')
<body class="vertical-layout vertical-content-menu 2-columns menu-expanded fixed-navbar" data-open="click"
      data-menu="vertical-content-menu" data-col="2-columns">

@include('dashboard/include/header')

<div class="app-content content">
    <div class="content-wrapper">
        <div class="content-header row">
        </div>
        @include('dashboard/include/sidebar')
        <div class="content-body"><!-- Analytics charts -->

        </div>
    </div>
</div>
<!-- ////////////////////////////////////////////////////////////////////////////-->

</div>
@include('dashboard/include/footer')
@include('dashboard/include/script')
</body>

</html>
