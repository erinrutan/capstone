var app = new Vue({
    el: '#app', // corresponds with div id in html file
    data: {
        product: 'Socks',
        image: '../frontend/greensocks.jpg',
        inventory: 100,
        details: ["80% cotton","20% polyester", "Gender-neutral"],
        variants: [
            {
                variantId: 2234,
                variantColor: 'green',
                variantImage: '../frontend/greensocks.jpg'
            },
            {
                variantId: 2235,
                variantColor: 'blue',
                variantImage: '../frontend/row.jpeg'
            }
        ],
        cart: 0
    },
    methods: {
        addToCart: function () {
            this.cart += 1
        }
    }
})