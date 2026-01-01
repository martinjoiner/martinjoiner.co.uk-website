
/**	
 * Initialising function that makes the email address revealable
 * This is all just to obfuscate my email address and make it a bit less discoverable for simple bots
 */
(function(){

	const elemPlaceholder = document.getElementById('emailPlaceholder')
	const emailAddress = reverseConcat([
		'uk','o.','.c','er','oin','inj','art',
		String.fromCharCode(109),
		'@','in','rt','ma'
	]);

	if (elemPlaceholder === null) {
		return;
	}

	elemPlaceholder.textContent = 'Show email address';

	elemPlaceholder.addEventListener( 'click', () => {

		// Create a new anchor element with a mailto href
		let elemAnchor = document.createElement('a');
		elemAnchor.href = 'mailto:' + emailAddress;
		elemAnchor.textContent = emailAddress;

		// Blank the placeholder and append the new anchor elements
		elemPlaceholder.textContent = '';
		elemPlaceholder.appendChild(elemAnchor);
	});

})();

/**	
 * Concatenates an array of strings in reverse order 
 *
 * @param {string[]} arrParts Array of strings that need concatenating in reverse order
 *
 * @return {string} The resulting string
 */
function reverseConcat(arrParts){
	let strReturn = '';
	
	// Iterate backwards over the array, building a string
	for (i = arrParts.length - 1; i >= 0; i--){
		strReturn += arrParts[i];
	}
	
	return strReturn;
}
