// userId.js
import express from 'express';
import fetch from 'node-fetch';

const router = express.Router();

// 🔐 Moodle Config
const MOODLE_TOKEN = 'd5a1f4ad4f953cbb4ccfd56fc19f48ab';
const MOODLE_URL = 'http://localhost/webservice/rest/server.php';
const MOODLE_USER_ID_FUNCTION = 'core_user_get_users';

// 📥 Route to fetch userid by email
router.post('/user/id', async (req, res) => {
  const { email } = req.body;

  if (!email) {
    return res.status(400).json({ error: 'Email is required' });
  }

  try {
    const formData = new URLSearchParams();
    formData.append('wstoken', MOODLE_TOKEN);
    formData.append('wsfunction', MOODLE_USER_ID_FUNCTION);
    formData.append('moodlewsrestformat', 'json');
    formData.append('criteria[0][key]', 'email');
    formData.append('criteria[0][value]', email);

    const response = await fetch(MOODLE_URL, {
      method: 'POST',
      headers: {
        'Content-Type': 'application/x-www-form-urlencoded'
      },
      body: formData
    });

    const data = await response.json();

    const userid = data.users?.[0]?.id || null;

    if (!userid) {
      return res.status(404).json({ error: 'User not found' });
    }

    return res.json({ userid });

  } catch (error) {
    console.error('UserID Fetch Error:', error);
    return res.status(500).json({ error: 'Server error while retrieving user id' });
  }
});

export default router;
