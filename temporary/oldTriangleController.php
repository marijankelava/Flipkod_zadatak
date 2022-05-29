/**
     * @Route("/triangle/{a}/{b}/{c}", name="app_triangle", defaults={"a"=null, "b"=null, "c"=null}, methods={"GET"})
     */
    public function index(): Response
    {
        return $this->json([
            'controller_name' => 'TriangleController',
        ]);
    }