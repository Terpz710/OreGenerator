<?php

declare(strict_types=1);

namespace Terpz710\OreGenerator;

use pocketmine\block\Block;
use pocketmine\block\VanillaBlocks;
use pocketmine\event\block\BlockFormEvent;
use pocketmine\event\Listener;
use pocketmine\item\StringToItemParser;
use pocketmine\plugin\PluginBase;

class Loader extends PluginBase implements Listener
{

    public function onEnable() : void
    {
        $this->saveDefaultConfig();
        $this->getServer()->getPluginManager()->registerEvents($this, $this);
    }

    public function onCobbleGenerateE(BlockFormEvent $event)
    {
        
        $event->cancel();

        $pos = $event->getBlock()->getPosition();
        
        $prob = $this->getConfig()->get("Probality");

        $isBlockPlaced = \false;
        $blockList = [];

        foreach($prob as $key => $value)
        {
            for($i = 0; $i < $value; $i++)
            {

                $block = StringToItemParser::getInstance()->parse($key);

                \array_push($blockList, $block->getBlock());

            }
        }
        $pos->getWorld()->setBlock($pos, $blockList[rand(0, \count($blockList) - 1)]);

    }

}