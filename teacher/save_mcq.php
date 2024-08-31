<?php 
session_start();
include 'includes/conn.php';

$question = $data['question'];
$choiceA = $data['choiceA'];
$choiceB = $data['choiceB'];
$choiceC = $data['choiceC'];
$choiceD = $data['choiceD'];
$correctAnswer = $data['correctAnswer'];

$query = "INSERT INTO MultipleChoice (Question, ChoiceA, ChoiceB, ChoiceC, ChoiceD, CorrectAnswer) VALUES (?, ?, ?, ?, ?, ?)";
$stmt = $conn->prepare($query);
$stmt->bind_param("ssssss", $question, $choiceA, $choiceB, $choiceC, $choiceD, $correctAnswer);

if ($stmt->execute()) {
    $last_id = $stmt->insert_id;
    $quizCode = mt_rand(1000, 9999) . '-' . $last_id;
    $updateQuery = "UPDATE MultipleChoice SET QuizCode = ? WHERE id = ?";
    $updateStmt = $conn->prepare($updateQuery);
    $updateStmt->bind_param("si", $quizCode, $last_id);
    $updateStmt->execute();
    echo json_encode(['success' => true]);
} else {
    echo json_encode(['success' => false, 'message' => 'Error: ' . $stmt->error]);
}

$stmt->close();
$conn->close();
?>