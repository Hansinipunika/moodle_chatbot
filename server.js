import express from 'express';
import cors from 'cors';
import bodyParser from 'body-parser';
import dotenv from 'dotenv';
import fetch from 'node-fetch';
import { OpenAI } from 'openai';
import { getEnrolledUsersByCourseName } from './enrolledUsers.js'; 
import { getUserRole } from './controllers/userController.js';
import { getUserDetails } from './controllers/userController.js';




dotenv.config();

const app = express();
const port = 5000;

//  Serve static files (chatbot UI)
app.use(express.static('public'));

// ✅ Middleware
app.use(cors());
app.use(bodyParser.json());

// 🧠 In-memory user context
const userContext = {};
function updateContext(email, key, value) {
  if (!userContext[email]) userContext[email] = {};
  userContext[email][key] = value;
}
function getContext(email, key) {
  return userContext[email]?.[key] || null;
}

// 🔐 Moodle API configuration
const MOODLE_TOKEN = 'd5a1f4ad4f953cbb4ccfd56fc19f48ab';
const MOODLE_URL = 'http://localhost/webservice/rest/server.php';
const MOODLE_ASSIGNMENT_FUNCTION = 'local_myapi_get_assignment_by_name';
const MOODLE_ENROLLED_USERS_FUNCTION = 'core_enrol_get_enrolled_users';
const MOODLE_COURSES_FUNCTION = 'core_course_get_courses';
const MOODLE_GRADES_FUNCTION = 'gradereport_user_get_grade_items';
const MOODLE_IDENTITY_FUNCTION = 'core_user_search_identity';
const MOODLE_USER_LOOKUP_FUNCTION = 'core_user_get_users';
const MOODLE_USER_COURSES_FUNCTION = 'core_enrol_get_users_courses';

// 🔐 OpenAI setup
const openai = new OpenAI({
  apiKey: process.env.OPENAI_API_KEY,
});

// ✅ Route: /user/role
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
    if (!courseId) return res.status(404).json({ error: 'No courses found' });

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

// ✅ Route: /user/details
app.post('/user/details', async (req, res) => {
  const { email } = req.body;
  if (!email) return res.status(400).json({ error: 'Email is required' });

  try {
    const response = await fetch(`${MOODLE_URL}?wstoken=${MOODLE_TOKEN}&wsfunction=${MOODLE_IDENTITY_FUNCTION}&moodlewsrestformat=json`, {
      method: 'POST',
      headers: { 'Content-Type': 'application/x-www-form-urlencoded' },
      body: new URLSearchParams({ query: email })
    });
    const data = await response.json();
    const fullname = data.list?.[0]?.fullname || null;

    if (!fullname) return res.status(404).json({ error: 'User not found' });
    res.json({ fullname });

  } catch (error) {
    console.error('Error in /user/details:', error);
    res.status(500).json({ error: 'Failed to fetch user details' });
  }
});

// ✅ Route: /user/id
app.post('/user/id', async (req, res) => {
  const { email } = req.body;
  if (!email) return res.status(400).json({ error: 'Email is required' });

  try {
    const params = new URLSearchParams();
    params.append('criteria[0][key]', 'email');
    params.append('criteria[0][value]', email);

    const response = await fetch(`${MOODLE_URL}?wstoken=${MOODLE_TOKEN}&wsfunction=${MOODLE_USER_LOOKUP_FUNCTION}&moodlewsrestformat=json`, {
      method: 'POST',
      headers: { 'Content-Type': 'application/x-www-form-urlencoded' },
      body: params
    });

    const data = await response.json();
    const userid = data.users?.[0]?.id;

    if (!userid) return res.status(404).json({ error: 'User not found' });
    res.json({ userid });

  } catch (error) {
    console.error('Error fetching user ID:', error);
    res.status(500).json({ error: 'Internal server error' });
  }
});

// ✅ Route: /user/courses
app.post('/user/courses', async (req, res) => {
  const { email } = req.body;
  if (!email) return res.status(400).json({ error: 'Email is required' });

  try {
    const params = new URLSearchParams();
    params.append('criteria[0][key]', 'email');
    params.append('criteria[0][value]', email);

    const userRes = await fetch(`${MOODLE_URL}?wstoken=${MOODLE_TOKEN}&wsfunction=${MOODLE_USER_LOOKUP_FUNCTION}&moodlewsrestformat=json`, {
      method: 'POST',
      headers: { 'Content-Type': 'application/x-www-form-urlencoded' },
      body: params
    });
    const userData = await userRes.json();
    const userId = userData.users?.[0]?.id;
    if (!userId) return res.status(404).json({ error: 'User not found' });

    const coursesRes = await fetch(`${MOODLE_URL}?wstoken=${MOODLE_TOKEN}&wsfunction=${MOODLE_USER_COURSES_FUNCTION}&moodlewsrestformat=json&userid=${userId}`);
    const courses = await coursesRes.json();
    if (!Array.isArray(courses) || courses.length === 0) return res.json({ courses: [] });

    const courseNames = courses.map(course => course.fullname);
    res.json({ courses: courseNames });

  } catch (err) {
    console.error('Error in /user/courses:', err);
    res.status(500).json({ error: 'Something went wrong' });
  }
});

// ✅ Route: /grades
app.post('/grades', async (req, res) => {
  const { email, course } = req.body;
  if (!email) return res.status(400).json({ error: 'Email is required' });

  try {
    const userParams = new URLSearchParams();
    userParams.append('criteria[0][key]', 'email');
    userParams.append('criteria[0][value]', email);

    const userRes = await fetch(`${MOODLE_URL}?wstoken=${MOODLE_TOKEN}&wsfunction=${MOODLE_USER_LOOKUP_FUNCTION}&moodlewsrestformat=json`, {
      method: 'POST',
      headers: { 'Content-Type': 'application/x-www-form-urlencoded' },
      body: userParams
    });

    const userData = await userRes.json();
    const userId = userData.users?.[0]?.id;
    if (!userId) return res.status(404).json({ error: 'User not found' });

    const coursesRes = await fetch(`${MOODLE_URL}?wstoken=${MOODLE_TOKEN}&wsfunction=${MOODLE_USER_COURSES_FUNCTION}&moodlewsrestformat=json&userid=${userId}`);
    const courses = await coursesRes.json();
    if (!Array.isArray(courses) || courses.length === 0) return res.json({ answer: 'No enrolled courses found.' });

    const filteredCourses = course
      ? courses.filter(c => c.fullname.toLowerCase() === course.toLowerCase())
      : courses;

    if (filteredCourses.length === 0) return res.json({ answer: `No enrolled course matched "${course}"` });

    const gradeLines = [];

    for (const c of filteredCourses) {
      const gradeURL = `${MOODLE_URL}?wstoken=${MOODLE_TOKEN}&wsfunction=${MOODLE_GRADES_FUNCTION}&moodlewsrestformat=json&userid=${userId}&courseid=${c.id}`;
      const gradeRes = await fetch(gradeURL);
      const gradeData = await gradeRes.json();
      const courseItem = gradeData.usergrades?.[0]?.gradeitems?.find(i => i.itemtype === 'course');
      const grade = courseItem?.graderaw ?? 'N/A';
      gradeLines.push(`${c.fullname}: ${grade}`);
    }

    res.json({ answer: gradeLines.join('\n') });

  } catch (error) {
    console.error('Error in /grades:', error);
    res.status(500).json({ error: 'Failed to fetch grades' });
  }
});

// ✅ Route: /grades/all (Instructor - All student grades)
app.post('/grades/all', async (req, res) => {
  const { email, courseName, role } = req.body;

  if (role !== 'instructor') {
    return res.status(403).json({ error: 'Access denied. Only instructors can view all student grades.' });
  }

  if (!email || !courseName) {
    return res.status(400).json({ error: 'Email and course name are required' });
  }

  try {
    const identityParams = new URLSearchParams();
    identityParams.append('criteria[0][key]', 'email');
    identityParams.append('criteria[0][value]', email);

    const userRes = await fetch(`${MOODLE_URL}?wstoken=${MOODLE_TOKEN}&wsfunction=${MOODLE_USER_LOOKUP_FUNCTION}&moodlewsrestformat=json`, {
      method: 'POST',
      headers: { 'Content-Type': 'application/x-www-form-urlencoded' },
      body: identityParams
    });

    const userData = await userRes.json();
    const instructorId = userData.users?.[0]?.id;
    if (!instructorId) return res.status(404).json({ error: 'Instructor not found' });

    const coursesRes = await fetch(`${MOODLE_URL}?wstoken=${MOODLE_TOKEN}&wsfunction=${MOODLE_USER_COURSES_FUNCTION}&moodlewsrestformat=json&userid=${instructorId}`);
    const courses = await coursesRes.json();
    const targetCourse = courses.find(c => c.fullname.toLowerCase() === courseName.toLowerCase());
    if (!targetCourse) return res.status(404).json({ error: 'Course not found or instructor not enrolled' });

    const enrolledRes = await fetch(`${MOODLE_URL}?wstoken=${MOODLE_TOKEN}&wsfunction=core_enrol_get_enrolled_users&moodlewsrestformat=json&courseid=${targetCourse.id}`);
    const enrolledUsers = await enrolledRes.json();

    const results = [];

    for (const student of enrolledUsers) {
      const gradeRes = await fetch(`${MOODLE_URL}?wstoken=${MOODLE_TOKEN}&wsfunction=${MOODLE_GRADES_FUNCTION}&moodlewsrestformat=json`, {
        method: 'POST',
        headers: { 'Content-Type': 'application/x-www-form-urlencoded' },
        body: new URLSearchParams({
          userid: student.id,
          courseid: targetCourse.id,
        }),
      });

      const gradeData = await gradeRes.json();
      const courseItem = gradeData.usergrades?.[0]?.gradeitems?.find(i => i.itemtype === 'course');
      const grade = courseItem?.graderaw ?? 'N/A';

      results.push(`${student.fullname}: ${grade}`);
    }

    res.json({ answer: `Grades for ${courseName}:\n${results.join('\n')}` });

  } catch (err) {
    console.error('Error in /grades/all:', err);
    res.status(500).json({ error: 'Something went wrong while retrieving grades.' });
  }
});




// ✅ Route: /assignment
app.post('/assignment', async (req, res) => {
  const { course, assignment } = req.body;

  if (!course || !assignment) {
    return res.status(400).json({ error: 'Course and assignment name are required' });
  }

  try {
    const url = `${MOODLE_URL}?wstoken=${MOODLE_TOKEN}&wsfunction=${MOODLE_ASSIGNMENT_FUNCTION}&moodlewsrestformat=json&coursename=${encodeURIComponent(course)}&assignmentname=${encodeURIComponent(assignment)}`;
    const response = await fetch(url);
    const data = await response.json();

    if (data.exception) {
      return res.status(400).json({ error: data.message });
    }

    const cleanIntro = data.intro?.replace(/<[^>]+>/g, '') || 'No instructions';
    const reply = `Assignment: ${data.name}\nDue: ${data.duedate}\nInstructions: ${cleanIntro}`;
    res.json({ answer: reply });

  } catch (error) {
    console.error('❌ Error in /assignment:', error);
    res.status(500).json({ error: 'Failed to fetch assignment details' });
  }
});

// ✅ Route: /enrolled-users
app.post('/enrolled-users', async (req, res) => {
  const { email, courseName, role } = req.body;

  if (!email || !courseName || !role) {
    return res.status(400).json({ error: 'email, courseName, and role are required' });
  }

  const result = await getEnrolledUsersByCourseName(email, courseName, role);

  if (result.error) {
    return res.status(403).json({ error: result.error });
  }

  res.json(result);
});

// ✅ Route: /chat
app.post('/chat', async (req, res) => {
  const { course, assignment, question } = req.body;

  if (!course || !assignment || !question) {
    return res.status(400).json({ error: 'course, assignment, and question are required' });
  }

  try {
    const moodleURL = `${MOODLE_URL}?wstoken=${MOODLE_TOKEN}&wsfunction=${MOODLE_ASSIGNMENT_FUNCTION}&moodlewsrestformat=json&coursename=${encodeURIComponent(course)}&assignmentname=${encodeURIComponent(assignment)}`;
    const moodleResponse = await fetch(moodleURL);
    const assignmentData = await moodleResponse.json();

    if (assignmentData.exception) {
      return res.status(400).json({ error: assignmentData.message });
    }

    const cleanIntro = assignmentData.intro?.replace(/<[^>]+>/g, '') || "No description provided.";
    const prompt = `
Assignment Name: ${assignmentData.name}
Due Date: ${assignmentData.duedate}
Instructions: ${cleanIntro}

User Question: ${question}
`;

    const completion = await openai.chat.completions.create({
      model: 'gpt-4',
      messages: [{ role: 'user', content: prompt }],
    });

    const reply = completion.choices[0].message.content;
    res.json({ reply });

  } catch (error) {
    console.error('❌ Error in /chat:', error);
    res.status(500).json({ error: 'Something went wrong while processing the question.' });
  }
});

// ✅ Start server
app.listen(port, () => {
  console.log(`✅ Server running at http://localhost:${port}`);
});

export default app; // testing

app.post('/user/role', getUserRole);
app.post('/user/details', getUserDetails);
