<link rel="stylesheet" href="{{ asset('vendor/shadow/swagger/swagger-ui.css') }}" />
<style>
    #swagger-ui,
    #swagger-ui * {
        direction: ltr !important;
        text-align: left !important;
    }
</style>
<script src="{{ asset('vendor/shadow/swagger/swagger-ui.js') }}"></script>
<script>
    const swagger_file = @json($swaggerFile);

    const initializeSwagger = () => {
        window.ui = SwaggerUIBundle({
            url: swagger_file,
            dom_id: '#swagger-ui',
            presets: [SwaggerUIBundle.presets.apis],
            plugins: [],
            showMutatedRequest: false,
            onComplete: () => setSwaggerDirection()
        });
    };

    const setSwaggerDirection = () => {
        const container = document.getElementById('swagger-ui');
        if (!container) {
            return;
        }
        container.setAttribute('dir', 'ltr');
    };

    window.addEventListener('load', initializeSwagger);
</script>

<div id="swagger-ui"></div>
