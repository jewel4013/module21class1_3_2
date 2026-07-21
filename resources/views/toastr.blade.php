<!doctype html>
<html lang="en" data-bs-theme="light">
    <head>
        <title>Title</title>
        <!-- Required meta tags -->
        <meta charset="utf-8" />
        <meta name="viewport" content="width=device-width, initial-scale=1" />

        <!-- Bootstrap CSS v5.3.8 -->
        <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/css/bootstrap.min.css" rel="stylesheet"/>
        <link href="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/css/toastr.min.css" rel="stylesheet"/>

    </head>

    <body>
        <header>
            <!-- place navbar here -->
        </header>
        <main>

            <button class="btn btn-success" onclick="success('Hi toastr')" id="success">Success</button>
            <button class="btn btn-info" onclick="info('info')" id="info">Info</button>
            <button class="btn btn-warning" id="warning">Warning</button>
            <button class="btn btn-danger" id="error">Error</button>
            

        </main>
        <footer>
            <!-- place footer here -->
        </footer>
        <!-- Bootstrap JavaScript Bundle (includes Popper) -->
        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/js/bootstrap.bundle.min.js"></script>
        <script src="https://cdn.jsdelivr.net/npm/jquery@3.6.4/dist/jquery.min.js"></script>
        <!-- Toastr -->
        <script src="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/js/toastr.min.js" ></script>
        <script>
            toastr.options = {
                    "closeButton": true,
                    "progressBar": true,
                    "positionClass": "toast-top-right",
                    "timeOut": "3000"
                };
            function success(msg){                
                toastr.success(msg);
            }

            function info(msg){
                toastr.info(msg);
            }

            function warning(msg){
                toastr.warning(msg);
            }

            function error(msg){
                toastr.error(msg);
            }
            
        </script>
    </body>
</html>
