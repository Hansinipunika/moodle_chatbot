// enrolledUsers.js
import fetch from 'node-fetch';

const MOODLE_TOKEN = 'd5a1f4ad4f953cbb4ccfd56fc19f48ab';
const MOODLE_URL = 'http://localhost/webservice/rest/server.php';
const MOODLE_ENROLLED_USERS_FUNCTION = 'core_enrol_get_enrolled_users';

export async function getEnrolledUsersByCourseName(email, courseName, role) {
  if (role !== 'instructor') {
    return { error: 'Access denied. Only instructors can view enrolled users.' };
  }

  try {
    // 🔹 Get user ID by email
    const userRes = await fetch(`${MOODLE_URL}?wstoken=${MOODLE_TOKEN}&wsfunction=core_user_get_users&moodlewsrestformat=json&criteria[0][key]=email&criteria[0][value]=${email}`);
    const userJson = await userRes.json();
    if (!userJson.users?.length) return { error: 'User not found.' };

    const userId = userJson.users[0].id;

    // 🔹 Get courses for the user
    const courseRes = await fetch(`${MOODLE_URL}?wstoken=${MOODLE_TOKEN}&wsfunction=core_enrol_get_users_courses&moodlewsrestformat=json&userid=${userId}`);
    const courseJson = await courseRes.json();

    const targetCourse = courseJson.find(c => c.fullname.toLowerCase() === courseName.toLowerCase());
    if (!targetCourse) return { error: 'Course not found or user not enrolled.' };

    // 🔹 Get enrolled users for the course
    const enrolledRes = await fetch(`${MOODLE_URL}?wstoken=${MOODLE_TOKEN}&wsfunction=${MOODLE_ENROLLED_USERS_FUNCTION}&moodlewsrestformat=json&courseid=${targetCourse.id}`);
    const enrolledUsers = await enrolledRes.json();

    // 🔹 Map and return results
    const result = enrolledUsers.map(u => `${u.fullname} (${u.email})`);
    return {
      users: result,
      count: result.length // ✅ NEW: include the total number of users
    };

  } catch (err) {
    console.error('❌ Error fetching enrolled users:', err);
    return { error: 'Internal server error' };
  }
}
