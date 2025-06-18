// // grades.js
// import express from 'express';
// import fetch from 'node-fetch';

// const router = express.Router();

// // Moodle Config
// const MOODLE_TOKEN = 'd5a1f4ad4f953cbb4ccfd56fc19f48ab';
// const MOODLE_URL = 'http://localhost/webservice/rest/server.php';
// const MOODLE_GET_USER = 'core_user_get_users';
// const MOODLE_GET_COURSES = 'core_enrol_get_users_courses';
// const MOODLE_GET_GRADES = 'gradereport_user_get_grade_items';

// // 📌 POST /grades - Get grades for all courses or one course
// router.post('/grades', async (req, res) => {
//   const { email, course: courseFilter } = req.body;

//   if (!email) {
//     return res.status(400).json({ error: 'Email is required' });
//   }

//   try {
//     // Step 1: Get user ID from email
//     const identityParams = new URLSearchParams();
//     identityParams.append('criteria[0][key]', 'email');
//     identityParams.append('criteria[0][value]', email);

//     const userRes = await fetch(`${MOODLE_URL}?wstoken=${MOODLE_TOKEN}&wsfunction=${MOODLE_GET_USER}&moodlewsrestformat=json`, {
//       method: 'POST',
//       headers: { 'Content-Type': 'application/x-www-form-urlencoded' },
//       body: identityParams,
//     });

//     const userData = await userRes.json();
//     const userId = userData.users?.[0]?.id;
//     if (!userId) {
//       return res.status(404).json({ error: 'User not found' });
//     }

//     // Step 2: Get enrolled courses
//     const coursesRes = await fetch(`${MOODLE_URL}?wstoken=${MOODLE_TOKEN}&wsfunction=${MOODLE_GET_COURSES}&moodlewsrestformat=json&userid=${userId}`);
//     const courses = await coursesRes.json();

//     if (!Array.isArray(courses) || courses.length === 0) {
//       return res.json({ answer: 'No enrolled courses found.' });
//     }

//     // Step 3: Fetch grades for each course
//     const results = [];
//     for (const course of courses) {
//       if (courseFilter && course.fullname.toLowerCase() !== courseFilter.toLowerCase()) continue;

//       const gradeRes = await fetch(`${MOODLE_URL}?wstoken=${MOODLE_TOKEN}&wsfunction=${MOODLE_GET_GRADES}&moodlewsrestformat=json`, {
//         method: 'POST',
//         headers: { 'Content-Type': 'application/x-www-form-urlencoded' },
//         body: new URLSearchParams({
//           userid: userId,
//           courseid: course.id,
//         }),
//       });

//       const gradeData = await gradeRes.json();
//       const courseItem = gradeData.usergrades?.[0]?.gradeitems?.find(i => i.itemtype === 'course');
//       const grade = courseItem?.graderaw ?? 'N/A';

//       results.push(`${course.fullname}: ${grade}`);
//     }

//     if (results.length === 0) {
//       return res.json({ answer: courseFilter ? `No grade found for "${courseFilter}".` : 'No grades found.' });
//     }

//     res.json({ answer: results.join('\n') });
//   } catch (err) {
//     console.error('Error in /grades:', err);
//     res.status(500).json({ error: 'Something went wrong fetching grades.' });
//   }
// });

// export default router;

// grades.js
import express from 'express';
import fetch from 'node-fetch';

const router = express.Router();

// Moodle Config
const MOODLE_TOKEN = 'd5a1f4ad4f953cbb4ccfd56fc19f48ab';
const MOODLE_URL = 'http://localhost/webservice/rest/server.php';
const MOODLE_GET_USER = 'core_user_get_users';
const MOODLE_GET_COURSES = 'core_enrol_get_users_courses';
const MOODLE_GET_GRADES = 'gradereport_user_get_grade_items';

// 📌 POST /grades - Get grades for all courses or one course (for students)
router.post('/grades', async (req, res) => {
  const { email, course: courseFilter } = req.body;

  if (!email) {
    return res.status(400).json({ error: 'Email is required' });
  }

  try {
    const identityParams = new URLSearchParams();
    identityParams.append('criteria[0][key]', 'email');
    identityParams.append('criteria[0][value]', email);

    const userRes = await fetch(`${MOODLE_URL}?wstoken=${MOODLE_TOKEN}&wsfunction=${MOODLE_GET_USER}&moodlewsrestformat=json`, {
      method: 'POST',
      headers: { 'Content-Type': 'application/x-www-form-urlencoded' },
      body: identityParams,
    });

    const userData = await userRes.json();
    const userId = userData.users?.[0]?.id;
    if (!userId) {
      return res.status(404).json({ error: 'User not found' });
    }

    const coursesRes = await fetch(`${MOODLE_URL}?wstoken=${MOODLE_TOKEN}&wsfunction=${MOODLE_GET_COURSES}&moodlewsrestformat=json&userid=${userId}`);
    const courses = await coursesRes.json();

    if (!Array.isArray(courses) || courses.length === 0) {
      return res.json({ answer: 'No enrolled courses found.' });
    }

    const results = [];
    for (const course of courses) {
      if (courseFilter && course.fullname.toLowerCase() !== courseFilter.toLowerCase()) continue;

      const gradeRes = await fetch(`${MOODLE_URL}?wstoken=${MOODLE_TOKEN}&wsfunction=${MOODLE_GET_GRADES}&moodlewsrestformat=json`, {
        method: 'POST',
        headers: { 'Content-Type': 'application/x-www-form-urlencoded' },
        body: new URLSearchParams({
          userid: userId,
          courseid: course.id,
        }),
      });

      const gradeData = await gradeRes.json();
      const courseItem = gradeData.usergrades?.[0]?.gradeitems?.find(i => i.itemtype === 'course');
      const grade = courseItem?.graderaw ?? 'N/A';

      results.push(`${course.fullname}: ${grade}`);
    }

    if (results.length === 0) {
      return res.json({ answer: courseFilter ? `No grade found for "${courseFilter}".` : 'No grades found.' });
    }

    res.json({ answer: results.join('\n') });
  } catch (err) {
    console.error('Error in /grades:', err);
    res.status(500).json({ error: 'Something went wrong fetching grades.' });
  }
});

// 📌 POST /grades/all - Instructor: get all students’ grades for a course
router.post('/grades/all', async (req, res) => {
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

    const userRes = await fetch(`${MOODLE_URL}?wstoken=${MOODLE_TOKEN}&wsfunction=${MOODLE_GET_USER}&moodlewsrestformat=json`, {
      method: 'POST',
      headers: { 'Content-Type': 'application/x-www-form-urlencoded' },
      body: identityParams
    });

    const userData = await userRes.json();
    const instructorId = userData.users?.[0]?.id;
    if (!instructorId) return res.status(404).json({ error: 'Instructor not found' });

    const coursesRes = await fetch(`${MOODLE_URL}?wstoken=${MOODLE_TOKEN}&wsfunction=${MOODLE_GET_COURSES}&moodlewsrestformat=json&userid=${instructorId}`);
    const courses = await coursesRes.json();
    const targetCourse = courses.find(c => c.fullname.toLowerCase() === courseName.toLowerCase());
    if (!targetCourse) return res.status(404).json({ error: 'Course not found or instructor not enrolled' });

    const enrolledRes = await fetch(`${MOODLE_URL}?wstoken=${MOODLE_TOKEN}&wsfunction=core_enrol_get_enrolled_users&moodlewsrestformat=json&courseid=${targetCourse.id}`);
    const enrolledUsers = await enrolledRes.json();

    const results = [];

    for (const student of enrolledUsers) {
      const gradeRes = await fetch(`${MOODLE_URL}?wstoken=${MOODLE_TOKEN}&wsfunction=${MOODLE_GET_GRADES}&moodlewsrestformat=json`, {
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

export default router;
