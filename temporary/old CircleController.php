/**
     * @Route("/circle", name="app_circle", defaults={"radius"=null}, methods={"GET"})
     */
    public function index(): Response
    {
        /*return $this->render('circle/index.html.twig', [
            'controller_name' => 'CircleController',
        ]);*/

        return $this->json([
            'message' => 'Welcome to your new controller',
            'path' => 'src/Controller/CircleController'
        ]);
    }