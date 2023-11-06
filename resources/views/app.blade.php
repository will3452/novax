<!DOCTYPE html>
<html>
  <head>
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0" />
    <link href="{{ mix('/css/app.css') }}" rel="stylesheet" />
    <script src="{{ mix('/js/app.js') }}" defer></script>
    <link rel="stylesheet" href="//cdn.jsdelivr.net/chartist.js/latest/chartist.min.css">
    <script src="//cdn.jsdelivr.net/chartist.js/latest/chartist.min.js"></script>
    <style>
      .ant-btn-primary  {
        background: gold !important; 
        border-color: gold !important; 
      }

      .ant-layout-header, .ant-menu-dark{
        background: #212021 !important; 
      }
    </style>
    @inertiaHead
  </head>
  <body>
    @inertia
  </body>
</html>
