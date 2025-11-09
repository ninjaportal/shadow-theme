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
        lightThemeName: 'light',
        toggleDarkMode() {
            this.dark = !this.dark
        },
        init() {
            this.watchDarkMode()

            const storedTheme = localStorage.getItem('darkMode')
            if (storedTheme === this.darkThemeName) {
                this.dark = true
            } else if (storedTheme === this.lightThemeName) {
                this.dark = false
            } else if (document.body.getAttribute('data-theme') === this.darkThemeName) {
                this.dark = true
            }

            const initialTheme = this.dark ? this.darkThemeName : this.lightThemeName
            document.body.setAttribute('data-theme', initialTheme)
            localStorage.setItem('darkMode', initialTheme)
        },
        watchDarkMode() {
            this.$watch('dark', value => {
                const theme = value ? this.darkThemeName : this.lightThemeName
                document.body.setAttribute('data-theme', theme)
                localStorage.setItem('darkMode', theme)

                if (value) {
                    import("@sweetalert2/theme-dark/dark.min.css")
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
