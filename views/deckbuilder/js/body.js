/**
 * 
 * Sorry, really ugly code right now, mostly just piecing stuff together until it works,
 * Hopefully I have the chance to pretty it up, but it all works, so that's a plus
 * 
 */

//This finds the first time a value exists in a multidemnsional array at the 0 index
Array.prototype.findIndex = function(needle, index) {
    index = index || 0;
    for (var i = index; i < this.length; i++) {
        if (this[i][0] === needle) {
            return i;
        }
    }
    return -1;
};
//This counts up the number of times a particular card exists
Array.prototype.indexCount = function(needle) {
    var index = this.findIndex(needle);
    var count = 0;
    while (index >= 0) {
        index = this.findIndex(needle, index + 1);
        count += 1;
    }
    return count;
};
//Need to make a new max function
Array.prototype.max = function() {
    return Math.max.apply(Math, this);
};
//Sorts the multidemensional Array
Array.prototype.sorter = function() {
    this.sort(function(a, b) {
        if (parseInt(a[2]) > parseInt(b[2]))
            return 1;
        if (parseInt(a[2]) < parseInt(b[2]))
            return -1;
        if (a[1] > b[1])
            return 1;
        if (a[1] < b[1])
            return -1;
        return 0;
    });
};
//Card Builder Object, stores all necessary data
function cardInfo() {
    this.cards = [];
    this.mana = function() {
        var m = [0,0,0,0,0,0,0,0];
        
        for(var i = 0; i < this.cards.length; i++) {
            var value = 0;
            if(this.cards[i][2] > 7) {
                value = 7;
            } else {
                value = this.cards[i][2];
            }
            m[value] += this.cards[i][3];
        }
        return m;
    };
    this.totalCards = function() {
        c = 0;
        for(var i = 0; i < this.cards.length; i++) {
            c += this.cards[i][3];
        }
        return c;
    };
}
var cardBuilder = new cardInfo();   //Makes the Deck Builder Object
//Makes sure the right amount of the card exists
function checkCard(type,findCard) { 
    if (type !== '4') {
            amount = 2;
        } else {
            amount = 1;
        }
        if(findCard > -1) {
            if(cardBuilder.cards[findCard][3] < amount) {
                return true;
            } else {
                return false;
            }
        } else {
            return true;
        }
        return false;
}
//Shows and Hides the pages Paginations for Ajax
$(document).ready(function() {
    $('#neutralPaginate').hide();
    $('#ClassButton').mousedown(function() {
        $('#classPaginate').show();
        $('#neutralPaginate').hide();
    });
    $('#NeutralButton').mousedown(function() {
        $('#neutralPaginate').show();
        $('#classPaginate').hide();
    });    
});
//Used for the mana curve, card list, and mana count
function list(mana) {
    //Writes up the list
    cardBuilder.cards.sorter();
    $('#pCards').html('<tr><td COLSPAN=\"2\" class=\"totalList\">Total Cards:</td><td class=\"totalListA\">' + cardBuilder.totalCards() + '</td></tr>');
    for (var i = 0; i < cardBuilder.cards.length; i++) {
        $('#pCards').append("<tr c_id=\"" + cardBuilder.cards[i][0] + "\" mana=\"" + cardBuilder.cards[i][2] + "\" class=\"list\"><td class=\"pCardsM\">" + cardBuilder.cards[i][2] + "</td><td  class=\"pCardsN\">" + cardBuilder.cards[i][1] + "</td><td class=\"pCardsA\">" + cardBuilder.cards[i][3] + "</td></tr>");
    }
    //Mana Curve
    if(mana > 7) {
        mana = 7;
    }
    $('#mCurve' + mana).html(cardBuilder.mana()[mana]);
    for (var i = 0; i < cardBuilder.mana().length; i++) {
        mCurveMax = cardBuilder.mana().max();
        if (mCurveMax > 0) {
            mCurveWidth = ((cardBuilder.mana()[i] / mCurveMax) * 100) + "%";
        } else {
            mCurveWidth = 0;
        }
        $('.mana[mana=' + i + "]").css({
            width: mCurveWidth
        });
    }
}
//Used when clicking on a card name
$('body').on('mousedown','.list',function(e) {
    c = $(e.target).parent(), c_id = c.attr('c_id') , mana = c.attr('mana');
    findCard = cardBuilder.cards.findIndex(c_id);
    if(findCard > -1) {
        if(cardBuilder.cards[findCard][3] > 1) {
            cardBuilder.cards[findCard][3] -= 1;
        } else {
            cardBuilder.cards.splice(findCard,1);
        }
    }
    list(mana);
    
});
//Used when left and right clicking on a card
$('body').on('mousedown','.card',function(e) {
    //On Image Click
    document.oncontextmenu = function() { return false; };
    c = $(e.target), c_id = c.attr('c_id'), card = c.attr('card'), mana = c.attr('mana'), type = c.attr('type');
    findCard = cardBuilder.cards.findIndex(c_id);
    check = checkCard(type,findCard);
    if (check === true && cardBuilder.totalCards() < 30) {
        if (e.which === 1) {
            //adds card to card Array
            if(findCard >= 0) {
                cardBuilder.cards[findCard] = [c_id, card, mana,2];
            } else {
                cardBuilder.cards.push([c_id, card, mana,1]);
            }
        }
    }
    //Deletes card if it exists
    if (e.which === 3) {
        if(cardBuilder.cards[findCard][3] > 1) {
            cardBuilder.cards[findCard][3] -= 1;
        } else {
            cardBuilder.cards.splice(findCard,1);
        }
    }
    list(mana);
});