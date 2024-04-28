<!DOCTYPE html>
<html dir="ltr" lang="en">
  @include('admin.includes.head')
  <body>
    @include('admin.includes.preloader')
    <div
      id="main-wrapper"
      data-layout="vertical"
      data-navbarbg="skin5"
      data-sidebartype="full"
      data-sidebar-position="absolute"
      data-header-position="absolute"
      data-boxed-layout="full"
    >
      @include('admin.includes.header')
      @include('admin.includes.aside')
      <div class="page-wrapper">
        @include('admin.includes.breadcrumb')
        @include($main)
        @include('admin.includes.footer')
      </div>
    </div>
    @include('admin.includes.script')
  </body>
</html>
