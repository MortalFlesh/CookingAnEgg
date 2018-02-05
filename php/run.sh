#!/usr/bin/env bash

docker run -it -v ~/www/CookingAnEgg:/usr/src/CookingAnEgg -w /usr/src/CookingAnEgg --rm --name cookingAnEgg cooking
