import Alpine from 'alpinejs'
import focus from '@alpinejs/focus'
import Swal from 'sweetalert2'

Alpine.plugin(focus)

window.Swal = Swal
window.Alpine = Alpine

document.addEventListener('alpine:init', () => {
    Alpine.data('darkMode', () => ({
        dark: false,
        darkThemeName: 'dark',
        toggleDarkMode() {
            this.dark = !this.dark
            document.body.setAttribute('data-theme', this.dark ? 'dark' : 'default');
            localStorage.setItem('darkMode', this.dark ? this.darkThemeName : 'default');
        },
        init() {
            this.watchDarkMode()

            this.dark = localStorage.getItem('darkMode') === 'dark';
                document.body.setAttribute('data-theme', this.dark ? this.darkThemeName : 'default');

            if (localStorage.getItem('darkMode') === 'dark') {
                this.dark = true
            }
            if (document.body.getAttribute('data-theme') === 'dark') {
                this.dark = true
            }
        },
        watchDarkMode() {
            this.$watch('dark', value => {
                if (value) {
                    document.body.setAttribute('data-theme', this.darkThemeName);
                    localStorage.setItem('darkMode', this.darkThemeName);
                    import("@sweetalert2/theme-dark/dark.min.css");
                }
            })
        }
    }))
    Alpine.data("dropdown", () => ({
        open: false,
        toggle() {
            console.log('toggle')
            if (this.open) {
                return this.close()
            }
            this.$refs.button.focus()
            this.open = true
        },
        close(focusAfter) {
            if (! this.open) return
            this.open = false
            focusAfter && focusAfter.focus()
        }
    }))
})

Alpine.start()
