function updateList(){
    let cardHolder = document.getElementById('cardHolder');
    cardHolder.remove()
    cardHolder = document.createElement("div");
    cardHolder.id = "cardHolder";
    document.body.appendChild(cardHolder);
    fetch('./data.json')
    .then(response => response.json())
    .then(function(cards){
        for (const key in cards) {
            if (cards[key].state == 1){
                createCard(cardHolder, cards[key]);
                cardHolder.lastChild.style.backgroundColor="#75d475ab"
            }
        }
        for (const key in cards) {
            if (cards[key].state == 0){
                createCard(cardHolder, cards[key]);
            }
        }
    })
}

function createCard(element, card){
    let newCard = document.createElement("div");
    newCard.className = "card";
    element.appendChild(newCard);

    let newOrden = document.createElement("h1")
    newOrden.className = "text"
    newOrden.innerText = "Orden: " + card.ordinal;
    element.lastChild.appendChild(newOrden);
    
    let newState = document.createElement("h1")
    newState.className = "text"
    newState.innerText = convertState(card.state);
    element.lastChild.appendChild(newState);
}

function checkChanges(text) {
    fetch('./data.json')
    .then(response => response.text())
    .then(function(response) {
        if(text != response){
            text = response;
            updateList();
        }
        return response;
    })
    .then(text => setTimeout(checkChanges(text),3000));
}

function convertState(state){
    switch (state) {
        case 0:
            return "En Preparacion";
        case 1:
            return "Listo";
        default:
            return "???";
    }
}