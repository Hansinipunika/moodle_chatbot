// courses.js
import express from 'express';
import fetch from 'node-fetch';

const router = express.Router();

const MOODLE_TOKEN = 'd5a1f4ad4f953cbb4ccfd56fc19f48ab';
const MOODLE_URL = 'http://localhost/webservice/rest/server.php';
const USER_COURSES_FUNCTION = 'core_enrol_get_users_courses';

router.post('/courses', async (req, res) => {
  const { userid } = req.body;

  if (!userid) {
    return res.status(400).json({ error: 'User ID is required.' });
  }

  try {
    const url = `${MOODLE_URL}?wstoken=${MOODLE_TOKEN}&wsfunction=${USER_COURSES_FUNCTION}&moodlewsrestformat=json&userid=${userid}`;
    const response = await fetch(url);
    const data = await response.json();

    // Debug log for verification
    console.log(`Courses for user ${userid}:`, data);

    if (!Array.isArray(data) || data.length === 0) {
      return res.json({ answer: `No courses found for user ${userid}.` });
    }

    const courseNames = data.map(c => c.fullname).join(', ');
    return res.json({ answer: `You are enrolled in the following courses: ${courseNames}` });

  } catch (err) {
    console.error('❌ Error fetching user courses:', err);
    return res.status(500).json({ error: 'Failed to fetch courses.' });
  }
});

export default router;
