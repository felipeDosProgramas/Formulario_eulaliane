<?php
    readonly class Rating
    {
        function __construct(
            public float $rate,
            public int   $count
        ){}
    }

    /**
     * Fiz esse mapeamento das propriedades da resposta
     * da API para ter autocomplete da minha IDE neles.
     */
    readonly class Produto
    {
        function __construct(
            public int      $id,
            public string   $title,
            public float    $price,
            public string   $description,
            public string   $category,
            public string   $image,
            public Rating   $rating
        ){}
    }

    /**
     * @internal
     * @return array
     */
    function pesquisar_produtos(): array
    {
        return json_decode(
            file_get_contents('https://fakestoreapi.com/products/category/electronics')
        );
    }

    /**
     * @api
     * @return Produto[]
     */
    function buscar_produtos(): array
    {
        return array_map(
            fn (object $produto): Produto => new Produto(
                $produto->id, $produto->title, $produto->price,
                $produto->description, $produto->category, $produto->image,
                new Rating(
                    $produto->rating->rate,
                    $produto->rating->count
                )
            ),
            pesquisar_produtos()
        );
    }
