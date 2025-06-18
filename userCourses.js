// userCourses.js (get courses by email)
import express from 'express';
import fetch from 'node-fetch';

const router = express.Router();

// Moodle config
const MOODLE_TOKEN = 'd5a1f4ad4f953cbb4ccfd56fc19f48ab';
const MOODLE_URL = 'http://localhost/webservice/rest/server.php';
const MOODLE_GET_USER = 'core_user_get_users';
const MOODLE_GET_USER_COURSES = 'core_enrol_get_users_courses';

// Route to fetch courses by email
router.post('/user/courses', async (req, res) => {
  const { email } = req.body;

  if (!email) {
    return res.status(400).json({ error: 'Email is required' });
  }

  try {
    // Step 1: Get user ID by email
    const identityParams = new URLSearchParams();
    identityParams.append('criteria[0][key]', 'email');
    identityParams.append('criteria[0][value]', email);

    const userRes = await fetch(`${MOODLE_URL}?wstoken=${MOODLE_TOKEN}&wsfunction=${MOODLE_GET_USER}&moodlewsrestformat=json`, {
      method: 'POST',
      headers: { 'Content-Type': 'application/x-www-form-urlencoded' },
      body: identityParams
    });

    const userData = await userRes.json();
    const userId = userData.users?.[0]?.id;

    if (!userId) {
      return res.status(404).json({ error: 'User not found' });
    }

    // Step 2: Get courses for user
    const coursesRes = await fetch(`${MOODLE_URL}?wstoken=${MOODLE_TOKEN}&wsfunction=${MOODLE_GET_USER_COURSES}&moodlewsrestformat=json&userid=${userId}`);
    const courses = await coursesRes.json();

    if (!Array.isArray(courses) || courses.length === 0) {
      return res.json({ courses: [] });
    }

    const courseNames = courses.map(course => course.fullname);
    res.json({ courses: courseNames });

  } catch (err) {
    console.error('Error in /user/courses:', err);
    res.status(500).json({ error: 'Something went wrong' });
  }
});

export default router;
