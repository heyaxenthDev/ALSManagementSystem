document
  .getElementById("addQuestionBtn")
  .addEventListener("click", function () {
    Swal.fire({
      title: "Add Multiple Choice Question",
      html: `
            <div class="form-group">
                <label for="question">Question</label>
                <input type="text" id="question" class="swal2-input" placeholder="Enter the question">
            </div>
            <div class="form-group">
                <label for="choiceA">Choice A</label>
                <input type="text" id="choiceA" class="swal2-input" placeholder="Enter choice A">
            </div>
            <div class="form-group">
                <label for="choiceB">Choice B</label>
                <input type="text" id="choiceB" class="swal2-input" placeholder="Enter choice B">
            </div>
            <div class="form-group">
                <label for="choiceC">Choice C</label>
                <input type="text" id="choiceC" class="swal2-input" placeholder="Enter choice C">
            </div>
            <div class="form-group">
                <label for="choiceD">Choice D</label>
                <input type="text" id="choiceD" class="swal2-input" placeholder="Enter choice D">
            </div>
            <div class="form-group">
                <label for="correctAnswer">Correct Answer</label>
                <select id="correctAnswer" class="swal2-input">
                    <option value="" disabled selected>Select the correct answer</option>
                    <option value="A">Choice A</option>
                    <option value="B">Choice B</option>
                    <option value="C">Choice C</option>
                    <option value="D">Choice D</option>
                </select>
            </div>
        `,
      focusConfirm: false,
      preConfirm: () => {
        const question = Swal.getPopup().querySelector("#question").value;
        const choiceA = Swal.getPopup().querySelector("#choiceA").value;
        const choiceB = Swal.getPopup().querySelector("#choiceB").value;
        const choiceC = Swal.getPopup().querySelector("#choiceC").value;
        const choiceD = Swal.getPopup().querySelector("#choiceD").value;
        const correctAnswer =
          Swal.getPopup().querySelector("#correctAnswer").value;

        if (
          !question ||
          !choiceA ||
          !choiceB ||
          !choiceC ||
          !choiceD ||
          !correctAnswer
        ) {
          Swal.showValidationMessage(`Please enter all fields`);
        }

        return { question, choiceA, choiceB, choiceC, choiceD, correctAnswer };
      },
    }).then((result) => {
      if (result.isConfirmed) {
        console.log(result.value);
        // Here you can handle the form data, e.g., sending it to the server or adding it to a table
        Swal.fire(`
                Question: ${result.value.question}
                Choice A: ${result.value.choiceA}
                Choice B: ${result.value.choiceB}
                Choice C: ${result.value.choiceC}
                Choice D: ${result.value.choiceD}
                Correct Answer: ${result.value.correctAnswer}
            `);
      }
    });
  });
