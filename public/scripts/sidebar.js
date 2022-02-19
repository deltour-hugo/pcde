(function () {
    let path = document.querySelector('#sidebar__wave path')
    let sidebarCategories = document.querySelectorAll('.sidebar__item')
    let from = path.getAttribute('d')
    let to = path.dataset['to']
    let options = {
                type: dynamics.easeOut,
                duration: 300,
                friction: 289
            }

    let sidebarOpened = false
    let menu__button = document.getElementById("nav__menu")

    menu__button.addEventListener('click', (e) => {
        if (menu__button.classList.contains("is-opened")) {
            menu__button.classList.add("is-closed")
            menu__button.classList.remove("is-opened")
        } else {
            menu__button.classList.add("is-opened")
            menu__button.classList.remove("is-closed")
            e.stopPropagation()
            e.preventDefault()
            document.body.classList.add('has-sidebar')
            dynamics.animate(path, {
                d: to
            }, options)
            sidebarCategories.forEach(function (link, i) {
                dynamics.animate(link, {
                    translateX: 0
                }, Object.assign({}, options, {delay: 50 * i}))
            })
            sidebarOpened = true
        }
    })

    document.body.addEventListener('click', () => {
        if (sidebarOpened) {
            document.body.classList.remove('has-sidebar')
            dynamics.animate(path, {
                d: from
            }, options)
            sidebarCategories.forEach(function (link, i) {
                dynamics.animate(link, {
                    translateX: 250
                }, options)
            })
            menu__button.classList.add("is-closed")
            menu__button.classList.remove("is-opened")
        }
    })

})()