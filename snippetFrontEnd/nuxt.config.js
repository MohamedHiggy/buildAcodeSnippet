let env = require("dotenv").config();
export default {
    // Global page headers (https://go.nuxtjs.dev/config-head)
    head: {
        titleTemplate: '%s - Snippets',
        meta: [
            { charset: 'utf-8' },
            { name: 'viewport', content: 'width=device-width, initial-scale=1' },
            { hid: 'description', name: 'description', content: '' }
        ],
        link: [
            { rel: 'icon', type: 'image/x-icon', href: '/favicon.ico' },
            { rel: 'stylesheet', href: 'https://fonts.googleapis.com/css2?family=Rubik:wght@400;500&display=swap' }
        ]
    },
    env: env.parsed,
    // Global CSS (https://go.nuxtjs.dev/config-css)
    css: [
        "~/assets/styles/app.scss"
    ],

    // Plugins to run before rendering page (https://go.nuxtjs.dev/config-plugins)
    plugins: [],

    // Auto import components (https://go.nuxtjs.dev/config-components)
    components: true,

    // Modules for dev and build (recommended) (https://go.nuxtjs.dev/config-modules)
    buildModules: [],

    // Modules (https://go.nuxtjs.dev/config-modules)
    modules: [
        // https://go.nuxtjs.dev/axios
        '@nuxtjs/axios',
        '@nuxtjs/auth',
        "@nuxtjs/toast"
    ],
    toast: {
        position: 'top-right',
        duration: 1500,
        theme: "outline",
        action: {
            text: 'cancel',
            onClick: (e, toastObject) => {
                toastObject.goAway(0);
            }
        }
    },
    // Axios module configuration (https://go.nuxtjs.dev/config-axios)
    axios: {
        baseURL: env.parsed.API_URL
    },
    auth: {
        redirect: {
            login: '/auth/login'
        },
        strategies: {
            local: {
                endpoints: {
                    login: {
                        url: 'auth/login',
                        method: 'post',
                        propertyName: 'data.token'
                    },
                    user: {
                        url: 'auth/me',
                        method: 'get',
                        propertyName: 'data'
                    },
                    logout: {
                        url: 'auth/logout',
                        method: 'post'
                    }
                }
            },
        }
    },
    // Build Configuration (https://go.nuxtjs.dev/config-build)
    build: {
        postcss: {
            plugins: {
                tailwindcss: "./tailwind.config.js"
            }
        }
    }
}