open System

let write (message: string) =
    printfn "%s" message

let wait n =
    n * 1000 |> Threading.Thread.Sleep

type Girl = Name of string
let speak (Name who) somethingImportant =
    wait 1
    write (sprintf "%s says: \"%s\"" who somethingImportant)

type Food =
    | Egg of string
    | Salt of string
    | Oil of string
    | Meal of string

type Item =
    | Food
    | EggPack of Food list
    | Cup of Food list
    | Ingredient of Food list
    | Pan of Food list

type HeatPosition =
    {   active: bool
        content: option<Food list> }

type Cooker =
    {   one: HeatPosition
        two: HeatPosition
        three: HeatPosition
        four: HeatPosition }

type Container =
    | Fridge of Item list
    | Shelf of Item list
    | Heater of Item list

let fridge = Fridge [ EggPack [ Egg "egg"; Egg "egg"; Egg "egg"; Egg "egg" ] ]
let shelf = Shelf [ Pan []; Cup []; Ingredient [Salt "salt"; Oil "oil";] ]
let cooker =
    {   one = { active = false; content = None}
        two = { active = false; content = None}
        three = { active = false; content = None}
        four = { active = false; content = None} }

let getEggPack (Fridge fridge) =
    fridge |> List.pick(fun i ->
        match i with
        | EggPack eggPack -> Some eggPack
        | _ -> None
    )

let getCup (Shelf shelf): Food list =
    shelf |> List.pick(fun i ->
        match i with
        | Cup cup -> Some cup
        | _ -> None
    )

let getPan (Shelf shelf): Food list =
    shelf |> List.pick(fun i ->
        match i with
        | Pan pan -> Some pan
        | _ -> None
    )

let getIngredient (Shelf shelf) =
    shelf |> List.pick(fun i ->
        match i with
        | Ingredient ingredient -> Some (Ingredient ingredient)
        | _ -> None
    )

let getSalt (Ingredient ingredient): Food =
    ingredient |> List.pick(fun s ->
        match s with
        | Salt salt -> Some (Salt salt)
        | _ -> None
    )

let getOil (Ingredient ingredient): Food =
    ingredient |> List.pick(fun s ->
        match s with
        | Oil oil -> Some (Oil oil)
        | _ -> None
    )

let putOn cookerPosition content =
    { cookerPosition with content = Some content }

let turnOn cookerPosition =
    { cookerPosition with active = true }

let turnOff cookerPosition =
    { cookerPosition with active = false }

let take n list =
    list |> List.take n

let count list =
    list |> List.length

let add content container =
    container |> List.append content

let mix food meal =
    let mealContent =
        match meal with
        | Egg egg -> egg
        | Salt salt -> salt
        | Oil oil -> oil
        | Meal meal -> meal
    Meal (if mealContent.Length > 0 then sprintf "%s|%s" mealContent food else food)

let (+>) = mix

let getFood (pan: option<Food list>) =
    match pan with
    | Some pan ->
        pan |> List.fold(fun meal food ->
            match food with
            | Egg egg -> egg +> meal
            | Salt salt -> salt +> meal
            | _ -> meal
        ) (Meal "")
    | _ -> Meal ""

let sometimeGirlCooksEggs () =
    let adin = Name "Adin"
    let adinSays = speak adin

    adinSays "I'm hungry, I'm going to cook some eggs."

    adinSays "I'm getting eggs from fridge."
    let eggs = fridge |> getEggPack |> take 2

    adinSays (sprintf "I have %d eggs now." (count eggs))

    adinSays "I'm putting eggs to cup."
    let cup = shelf |> getCup
    let cupWithEggs = cup |> add eggs

    adinSays "I'm adding some salt to the cup."
    let salt = shelf |> getIngredient |> getSalt
    let fullCup = cupWithEggs |> add [salt]

    adinSays "I'm getting a pan."
    let pan = shelf |> getPan

    adinSays "I'm adding oil to pan."
    let oil = shelf |> getIngredient |> getOil
    let panWithOilAndEggs = 
        pan
        |> add [oil]
        |> add fullCup

    adinSays "I'm putting a pan on the cooker."
    let cookerWithPan = { cooker with one = (panWithOilAndEggs |> putOn cooker.one) }

    adinSays "I'm turning on the cooker."
    let activeHeaterWithPan = { cookerWithPan with one = turnOn cookerWithPan.one }

    adinSays "I'm adding cup content to the pan."
    // its already in pan due immutable records :-D

    adinSays "I'm waiting till it's done."
    wait 5

    adinSays "I'm turning off the cooker."
    let cookerWithFinishedFood = { activeHeaterWithPan with one = turnOff activeHeaterWithPan.one }

    adinSays "I'm removing a pan from cooker."
    let eggsOnPan = cookerWithFinishedFood.one.content

    adinSays "I'm getting cooked eggs."
    let eggFood = eggsOnPan |> getFood

    adinSays "I'm enjoying cooked eggs."
    eggFood

sometimeGirlCooksEggs()
