import fetch from 'node-fetch';

const MOODLE_TOKEN = 'd5a1f4ad4f953cbb4ccfd56fc19f48ab';
const MOODLE_URL = 'http://localhost/webservice/rest/server.php';

// 🧠 Context Store (optional - you can also manage this in your main server file)
const userContext = {};
export function updateContext(email, key, value) {
  if (!userContext[email]) userContext[email] = {};
  userContext[email][key] = value;
}
export function getContext(email, key) {
  return userContext[email]?.[key] || null;
}

// 📦 Exported route function
export function registerUserRoleRoute(app) {
  app.post('/user/role', async (req, res) => {
    const { email } = req.body;
    if (!email) return res.status(400).json({ error: 'Email is required' });

    try {
      const params = new URLSearchParams();
      params.append('criteria[0][key]', 'email');
      params.append('criteria[0][value]', email);

      const userRes = await fetch(`${MOODLE_URL}?wstoken=${MOODLE_TOKEN}&wsfunction=core_user_get_users&moodlewsrestformat=json`, {
        method: 'POST',
        headers: { 'Content-Type': 'application/x-www-form-urlencoded' },
        body: params
      });
      const userData = await userRes.json();
      const userId = userData.users?.[0]?.id;
      if (!userId) return res.status(404).json({ error: 'User not found' });

      const courseRes = await fetch(`${MOODLE_URL}?wstoken=${MOODLE_TOKEN}&wsfunction=core_enrol_get_users_courses&moodlewsrestformat=json&userid=${userId}`);
      const courses = await courseRes.json();
      const courseId = courses?.[0]?.id;
      if (!courseId) return res.status(404).json({ error: 'No courses found for user' });

      const enrolledRes = await fetch(`${MOODLE_URL}?wstoken=${MOODLE_TOKEN}&wsfunction=core_enrol_get_enrolled_users&moodlewsrestformat=json&courseid=${courseId}`);
      const enrolledList = await enrolledRes.json();

      const user = enrolledList.find(u => u.id === userId);
      const role = user?.roles?.[0]?.shortname || 'student';

      updateContext(email, 'role', role);
      res.json({ role });

    } catch (error) {
      console.error('❌ Error in /user/role:', error);
      res.status(500).json({ error: 'Failed to fetch user role' });
    }
  });
}
