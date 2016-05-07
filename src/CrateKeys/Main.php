<?php

namespace CrateKeys;

use pocketmine\Server;
use pocketmine\Player;
use pocketmine\event\player\PlayerInteractEvent;
use pocketmine\plugin\PluginBase;
use pocketmine\event\Listener;
use pocketmine\item\Item;
use pocketmine\utils\TextFormat;
use pocketmine\utils\Config;
use pocketmine\command\ConsoleCommandSender;
use pocketmine\command\Command;
use pocketmine\command\CommandSender;
use pocketmine\player\Inventory;

class Main extends PluginBase implements Listener {

public function onEnable(){
$this->getServer()->getPluginManager()->registerEvents($this, $this);
$this->saveDefaultConfig();
$config = $this->getConfig();
$this->getServer()->getLogger()->info(TextFormat::BLUE."[CrateKeys] Enabled!");
}

public function onCrateTap(PlayerInteractEvent $event){
    $config = $this->getConfig();
		$player = $event->getPlayer();
		$key = $player->getInventory()->getItemInHand()->getId();
		$crate = $event->getBlock()->getId();
		if($key == $config->get("key")){
			if($crate == $config->get("Block")){
			
			
			//IF RANDOMIZE IS TRUE
			if($config->get("randomize") == true){
			$amount = rand($config->get("min-rand"),$config->get("max-rand"));
				for($i = 1; $i <= $amount; $i++){
					$randomize = $this->getConfig()->get("Items");
					$player->getInventory()->addItem(Item::get($randomize));
					}
				}
					
				//IF RANDOMIZE IS FALSE
			if($config->get("randomize") == false){
			$amount = $config->get("amount");
				for($i = 1; $i <= $amount; $i++){
					$items = $this->getConfig()->get("Items");
					$player->getInventory()->addItem(Item::get($items));
				
					}
					$player->sendMessage(TextFormat::GREEN."[CrateKeys] You received $amount items!");
					$player->sendMessage(TextFormat::GREEN."[CrateKeys] Check Your inventory to see it!");
				}
				
			//IF BROADCAST IS TRUE
			if($config->get("broadcast") == true){
			$msg = $config->get("broadcast-message");
      $msg = str_replace("{PLAYER}", $player->getName(), $msg);
      $msg = str_replace("{AMOUNT}", $amount, $msg);
      $msg = str_replace("&", "§", $msg);
      }
				}
			}
		}
		
		
		public function onSendKeys(CommandSender $sender, Command $cmd, $label, array $args) {
        if(strtolower($cmd->getName()) === "key") {
        if(isset($args[1])) {
        $config = $this->getConfig();
                $key = $config->get("key");
                $keys = $args[0];
                $playerName = $args[1];
                $player = $this->getServer()->getPlayer($playerName);
                $player->getInventory()->addItem(Item::get($key));
                $player->sendMessage(TextFormat::GREEN."You just received $keys keys!");
                if($sender instanceof Player){
                $player->sendMessage(TextFormat::GREEN."Sent $keys keys to $playerName");
                return true;
                }
	}
	}
	}
}
				
