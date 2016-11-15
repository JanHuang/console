<?php
/**
 * @author    jan huang <bboyjanhuang@gmail.com>
 * @copyright 2016
 *
 * @link      https://www.github.com/janhuang
 * @link      http://www.fast-d.cn/
 */

use FastD\Console\Command\Command;
use FastD\Console\Input\InputInterface;
use FastD\Console\Output\OutputInterface;
use Symfony\Component\Console\Formatter\OutputFormatterStyle;

class QRCodeCommand extends Command
{
    /**
     * @return string
     */
    public function getName()
    {
        return 'qrcode';
    }

    /**
     * @return mixed
     */
    public function configure()
    {
        // TODO: Implement configure() method.
    }

    /**
     * @param InputInterface $input
     * @param OutputInterface $output
     * @return mixed
     */
    public function execute(InputInterface $input, OutputInterface $output)
    {
        $url = 'http://qr.liantu.com/api.php?text=http://zhangge.net';

//        $qrCode = file_get_contents($url);

        $text = [
            '111111100101101111111',
            '100000101101001000001',
            '101110101100101011101',
            '101110100101001011101',
            '101110101000101011101',
            '100000101001101000001',
            '111111101010101111111',
            '000000001111100000000',
            '110100110110001110110',
            '011111011100001000011',
            '001101111010110001101',
            '000101001001000001011',
            '000010110110101010000',
            '000000001111000110101',
            '111111101110010101110',
            '100000100111110110000',
            '101110100101001110001',
            '101110101011000101111',
            '101110100110100010101',
            '100000101110011000000',
            '111111101011100101010',
        ];

        $map = array(
            0 => '<info>  </info>',
            1 => '<success>  </success>',
        );

        $length = strlen($text[0]);

        foreach ($text as $line) {
            $line = (string) $line;
            $output->write(str_repeat($map[0], 1));
            for ($i = 0; $i < $length; $i++) {
                $type = substr($line, $i, 1);
                $output->write($map[$type]);
            }
            $output->writeln(str_repeat($map[0], 1));
        }
    }
}