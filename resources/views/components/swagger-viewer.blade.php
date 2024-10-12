<link rel="stylesheet" href="{{ asset("vendor/shadow/swagger/swagger-ui.css") }}" />
<script src="{{ asset("vendor/shadow/swagger/swagger-ui.js") }}"></script>
<script>
        const swagger_file = '{{ $swaggerFile }}';

        window.onload = () => {
            window.ui = SwaggerUIBundle({
                url: swagger_file,
                dom_id: '#swagger-ui',
                presets: [
                    SwaggerUIBundle.presets.apis
                ],
                plugins: [],
                // TODO: Add the plugins (proxy, auth)
                // to hide the change on the request url we made
                showMutatedRequest: false,
            });
            window.ui.injectCSS('https://raw.githubusercontent.com/Amoenus/SwaggerDark/master/SwaggerDark.css');
        };
    </script>

<div id="swagger-ui"></div>
