<template>
    <a class="wishlist-btn unset" :href="src">
        <i class="material-icons">favorite_border</i>

        <div class="badge-container" v-if="wishlistCount > 0">
            <span class="badge" v-text="wishlistCount"></span>
        </div>

        <span v-if="fetchingWishlists">Loading...</span>
        <span
            v-else-if="isText == 'true'"
            v-text="__('header.wishlist')"
        ></span>
    </a>
</template>

<script type="text/javascript">
export default {
    props: ['isCustomer', 'isText', 'src'],

    data: function() {
        return {
            wishlistCount: 0,
            fetchingWishlists: false
        };
    },

    watch: {
        '$root.headerItemsCount': function() {
            this.updateHeaderItemsCount();
        }
    },

    created: function() {
        this.updateHeaderItemsCount();
    },

    methods: {
        updateHeaderItemsCount: function() {
            if (this.isCustomer == 'true') {
                this.fetchingWishlists = true;
                this.$http
                    .get(`${this.$root.baseUrl}/items-count`)
                    .then(response => {
                        this.wishlistCount =
                            response.data.wishlistedProductsCount;
                    })
                    .catch(exception => {
                        console.log(this.__('error.something_went_wrong'));
                    })
                    .finally(() => this.fetchingWishlists = false);
            }
        }
    }
};
</script>
