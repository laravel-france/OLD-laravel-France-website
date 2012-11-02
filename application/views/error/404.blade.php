@layout('main')

@section('content')
            <?php $messages = array('Où est la carte ?.', 'Je pense que nous sommes perdu.', 'On s\'est trompé de virage !'); ?>

            <h1><?php echo $messages[mt_rand(0, 2)]; ?></h1>

            <h2>404, page non trouvée !</h2>


            <h3>Qu'est ce que cela signifie ?</h3>

            <p>
                Nous n'avons pas trouver cette page sur nos serveurs. Nous en sommes désolé ! Si un lien nous vous à conduit ici, peut-être pourriez vous nous donner l'information ? Pour cela, rendez vous sur la page {{ HTML::link_to_action('contact','contact') }}.
            </p>

            <p>
                Vous pouvez vous rediriger vers la {{ HTML::link('/', 'page d\'accueil'); }} !
            </p>

@endsection
