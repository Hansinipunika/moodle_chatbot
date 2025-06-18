// assignment.js — Fetch assignment details by course and assignment name
import express from 'express';
import fetch from 'node-fetch';

const router = express.Router();

// Moodle config
const MOODLE_TOKEN = 'd5a1f4ad4f953cbb4ccfd56fc19f48ab';
const MOODLE_URL = 'http://localhost/webservice/rest/server.php';
const MOODLE_ASSIGNMENT_FUNCTION = 'local_myapi_get_assignment_by_name';

// Route: /assignment/details
router.post('/assignment/details', async (req, res) => {
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

    const reply = `Assignment: ${data.name}\nDue: ${data.duedate}\nInstructions: ${data.intro.replace(/<[^>]+>/g, '')}`;
    res.json({ answer: reply });

  } catch (error) {
    console.error('❌ Error in /assignment/details:', error);
    res.status(500).json({ error: 'Failed to fetch assignment details' });
  }
});

export default router;
