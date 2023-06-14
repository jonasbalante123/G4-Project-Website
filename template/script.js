// Get the necessary DOM elements
const answerTypeSelect = document.getElementById('answer-type');
const questionSection = document.getElementById('question-section');
const optionsSection = document.getElementById('options-section');
const trueAnswerSection = document.getElementById('true-answer-section');

// Listen for changes in the answer type selection
answerTypeSelect.addEventListener('change', function() {
  const selectedAnswerType = answerTypeSelect.value;

  // Show or hide the question, options, and true answer sections based on the selected answer type
  if (selectedAnswerType === 'multiple-choice') {
    questionSection.classList.remove('hidden');
    optionsSection.classList.remove('hidden');
    trueAnswerSection.classList.add('hidden');
  } else if (selectedAnswerType === 'true-false') {
    questionSection.classList.remove('hidden');
    optionsSection.classList.add('hidden');
    trueAnswerSection.classList.remove('hidden');
  } else if (selectedAnswerType === 'identification') {
    questionSection.classList.remove('hidden');
    optionsSection.classList.add('hidden');
    trueAnswerSection.classList.add('hidden');
  } else {
    questionSection.classList.add('hidden');
    optionsSection.classList.add('hidden');
    trueAnswerSection.classList.add('hidden');
  }
});
