var Eat = document.getElementById('Eat'),
    Power = document.getElementById('Power'),
    mon1 = document.getElementById('mon1'),
    mon2 = document.getElementById('mon2');

Eat.onclick = function() {
    'use strict'
    mon1.style.display = 'none';

};

Power.onclick = function() {
    'use strict';
    Eat.addEventListener('click', function() {
        mon2.style.display = 'none';
    });
};