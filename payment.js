// payment.js

const express = require("express");
const app = express();
const stripe = require("stripe")("YOUR_STRIPE_SECRET_KEY");

app.post("/create-payment-intent", async (req, res) => {
    try {
        const paymentIntent = await stripe.paymentIntents.create({
            amount: 1000,
            currency: "usd",
            payment_method_types: ["card"],
        });
        res.json({ paymentIntent: paymentIntent });
    } catch (err) {
        console.error(err);
        res.status(500).json({ error: "Failed to create payment intent" });
    }
});

app.listen(3000, () => {
    console.log("Server started on port 3000");
});