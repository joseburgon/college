<template>
  <form action="/response" method="GET">
  <script
   src="https://www.mercadopago.com.co/integrations/v1/web-payment-checkout.js"
   type="application/javascript"
   :data-preference-id="preference">
  </script>
</form>

</template>

<script>
export default {
    name: "Pay",

    data() {
        return {
            preference: "",
        };
    },

    created() {
        this.preference = this.$route.params.preference;
    }
}
</script>

<style>

</style>