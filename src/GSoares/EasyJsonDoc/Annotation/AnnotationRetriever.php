<?php
namespace GSoares\EasyJsonDoc\Annotation;

class AnnotationRetriever
{

    /**
     * @param string $docComment
     * @return Annotation[]
     */
    public function retrieve($docComment)
    {
        $lines = explode(PHP_EOL, $docComment);

        $out = [];

        foreach ($lines as $commentLine) {
            if ($annotation = $this->search($commentLine)) {
                $out[] = $annotation;
            }
        }

        return $out;
    }

    /**
     * @param string $commentLine
     * @return Annotation
     */
    private function search($commentLine)
    {
        if (!($var = strstr($commentLine, '@')) && !($var = strstr($commentLine, 'return '))) {
            return;
        }

        $parts = explode(' ', $var);
        $annotation = new Annotation();
        $annotation->name = $parts[0];

        if ($annotation->name == Annotation::ANNOTATION_SAMPLE) {
            $annotation->value = implode(' ', array_slice($parts, 1));
        }

        if (in_array($annotation->name, [Annotation::ANNOTATION_VAR, Annotation::ANNOTATION_PARAM, Annotation::ANNOTATION_RETURN])) {
            $annotation->value = $parts[1];
            $annotation->comment = implode(' ', array_slice($parts, 2));
        }

        return $annotation;
    }
}