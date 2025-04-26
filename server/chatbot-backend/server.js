const express = require('express');
const app = express();
const cors = require('cors');

// Middlewares
app.use(cors());
app.use(express.json());

// Test endpoint
app.post('/chat', (req, res) => {
    const userMessage = req.body.message;
    console.log('Student asked:', userMessage);

    // Send a dummy reply for now
    res.json({ reply: `You said: "${userMessage}". I'll help you soon!` });
});

// Start server
const PORT = 4000;
app.listen(PORT, () => {
    console.log(`Backend server is running at http://localhost:${PORT}`);
});
