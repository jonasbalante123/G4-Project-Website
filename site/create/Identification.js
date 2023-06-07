<script>
  // Get the input fields and preview element
  const questionInput = document.getElementById('question');
  const optionsContainer = document.querySelector('.options-container');
  const previewElement = document.getElementById('preview');

  // Add event listener to the question input field
  questionInput.addEventListener('input', updatePreview);

  // Function to update the preview
  function updatePreview() {
    const question = questionInput.value;

    // Generate the preview HTML
    const previewHTML = `
      <p><strong>Question:</strong> ${question}</p>
    `;

    // Update the preview element
    previewElement.innerHTML = previewHTML;
  {"}"}

  // Add event listener to the options container
  optionsContainer.addEventListener('click', handleOptionClick);

  // Function to handle option button clicks
  function handleOptionClick(event) {
    if (event.target.tagName === 'BUTTON') {
      const option = event.target.textContent;

      // Generate the option HTML
      const optionHTML = `<button type="button">${option}</button>`;

      // Append the option to the preview element
      previewElement.insertAdjacentHTML('beforeend', optionHTML);
    {"}"}
  {"}"}
</script>
