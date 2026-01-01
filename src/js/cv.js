
const highlightColours = [
    'yellow',
    'green',
    'turquoise',
    'pink',
    'orange',
    'purple',
    'blue'
]

let colourPointer = 0;

/** @var {string[]} highlightedTags */
let highlightedTags = [];

function tagClicked(evt) {
    const tag = evt.target.dataset.tag;
    if (highlightedTags.includes(tag)) {
        return lowlightAllTags(tag);
    }

    highlightAllTags(tag);
}

// Initialise by attaching click listener to all tags
for (const tagElem of document.getElementsByClassName('tag')) {
    tagElem.addEventListener('mouseup', tagClicked);
}

function gimmeNextColour() {
    let colour = highlightColours[colourPointer];
    colourPointer = colourPointer >= highlightColours.length - 1 ? 0 : colourPointer + 1;
    return colour;
}

function highlightAllTags(tag) {
    highlightedTags.push(tag);
    const colour = gimmeNextColour();

    let taggedElems = document.getElementsByClassName(tag);
    for (let i = 0, iLimit = taggedElems.length; i < iLimit; i++) {
        taggedElems[i].className += ' tag-highlight-' + colour;
    }
}

function lowlightAllTags(tag) {
    const index = highlightedTags.indexOf(tag);
    if (index > -1) {
        highlightedTags.splice(index, 1);
    }

    let taggedElems = document.getElementsByClassName(tag);
    for (let i = 0, iLimit = taggedElems.length; i < iLimit; i++){
        taggedElems[i].className = taggedElems[i].className.replace(/ tag-highlight-[a-z]+/, '');
    }
}
