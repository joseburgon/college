<template>
  <p>{{ confirmationInfo }}</p>
</template>

<script>
import { db } from "../firebase/db";

export default {
  data() {
    return {
      confirmationInfo: this.$route.query,
      Payments: [],
    };
  },
  methods: {
    async addPayment() {
      let data = this.confirmationInfo;
      let payments = db.collection("Payments");

      await db;
      payments
        .doc(`${data.transactionId}`)
        .set(data)
        .then(function() {
          console.log("Payment successfully stored!");
        })
        .catch(function(error) {
          console.error("Error writing document: ", error);
        });
    },
  },
  created() {
    this.addPayment();
  },
  firestore: {
    Payments: db.collection("Payments"),
  },
};
</script>
