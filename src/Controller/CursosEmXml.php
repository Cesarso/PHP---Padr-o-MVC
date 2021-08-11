<?php


namespace Alura\Cursos\Controller;


use Alura\Cursos\Entity\Curso;
use Doctrine\ORM\EntityManagerInterface;
use Nyholm\Psr7\Response;
use Psr\Http\Message\ResponseInterface;
use Psr\Http\Message\ServerRequestInterface;
use Psr\Http\Server\RequestHandlerInterface;

class CursosEmXml implements RequestHandlerInterface
{

    /**
     * @var \Doctrine\Persistence\ObjectRepository
     */
    private $repositorioDeCursos;

    public function __construct(EntityManagerInterface $entityManager)
    {
        $this->repositorioDeCursos = $entityManager
            ->getRepository(Curso::class);
    }


    public function handle(ServerRequestInterface $request): ResponseInterface
    {
        /** @var Curso[] $curso */
        $cursos = $this->repositorioDeCursos->findAll();
        $cursoEmXml = new \SimpleXMLElement('<curso/>');

        foreach ($cursos as $curso){
            $cursoEmXml->$cursosEmXml-addChild('curso');
            $cursoEmXml->addChild('id',$curso->getId());
            $cursoEmXml->addChild('descricao', $curso-> getDescricao);
        }
        return new Response(200,
            ['Content-Type'=>application/xml],
            $cursosEmXml->asXML()
    );


    }
}