<!DOCTYPE html>
<html lang="ja">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-giJF6kkoqNQ00vy+HMDP7azOuL0xtbfIcaT9wjKHr8RbDVddVHyTfAAsrekwKmP1" crossorigin="anonymous">
    <link rel="stylesheet" type="text/css" href="{{ asset('/css/base.css') }}" media="all">
    <script src="/js/jquery-3.6.0.min.js"></script>
    <!-- <script src="/js/common.js"></script> -->
    <title></title>    
    <script>
        $(function(){            
            $('.close, .overlay').click(function(){
                $('.modal').fadeOut();
                $('.overlay').fadeOut();
            });

            $('.close-script, .overlay-script').click(function(){
                $('.modal-script').fadeOut();
                $('.overlay-script').fadeOut();
            });
        });
    </script>
</head>
<body>
    @yield('script')
    @yield('body')
</body>
</html> 