let codeTags = document.querySelectorAll('code');

// decodeHTMLEntities function: https://stackoverflow.com/a/17076120/17273033
function decodeHTMLEntities(text)
{
    let entities = [
        ['amp', '&'],
        ['apos', '\''],
        ['#x27', '\''],
        ['#x2F', '/'],
        ['#39', '\''],
        ['#47', '/'],
        ['lt', '<'],
        ['gt', '>'],
        ['nbsp', ' '],
        ['quot', '"']
    ];

    for (let i = 0, max = entities.length; i < max; ++i) 
        text = text.replace(new RegExp('&'+entities[i][0]+';', 'g'), entities[i][1]);

    return text;
}

codeTags.forEach(tag => {
    let text = tag.innerText;
    tag.innerText = decodeHTMLEntities(text);
});