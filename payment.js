// payment.js

const express = require("express");
const stripe = require("stripe")("YOUR_STRIPE_SECRET_KEY");

const app = express();

// Middleware to parse JSON bodies
app.use(express.json());

// Create payment intent endpoint
app.post("/create-payment-intent", async (req, res) => {
    try {
        const paymentIntent = await stripe.paymentIntents.create({
            amount: 1000,
            currency: "usd",
            payment_method_types: ["card"],
        });
        res.json({ clientSecret: paymentIntent.client_secret });
    } catch (err) {
        console.error(err);
        res.status(500).json({ error: "Failed to create payment intent" });
    }
});

// Start server
const port = 3000;
app.listen(port, () => {
    console.log(`Server started on port ${port}`);
});