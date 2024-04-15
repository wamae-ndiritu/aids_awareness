<?php
$topic = $_GET['topic'] ?? 'introduction';
$subtopic = $_GET['subtopic'] ?? 'what_is_hiv';

// Include content based on selected topic and subtopic
if ($topic === 'introduction') {
    if ($subtopic === 'what_is_hiv') {
        include 'topics/introduction/what_is_hiv.php';
    } elseif ($subtopic === 'what_is_aids') {
        include 'topics/introduction/what_is_aids.php';
    }
} elseif ($topic === 'prevention') {
    if ($subtopic === 'safer_sex') {
        include 'topics/prevention/safer_sex.php';
    } elseif ($subtopic === 'condom_use') {
        include 'topics/prevention/condom_use.php';
    }
}
?>