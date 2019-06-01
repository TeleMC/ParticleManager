<?PHP

namespace ParticleManager;

use pocketmine\command\Command;
use pocketmine\command\CommandSender;
use pocketmine\level\Location;
use pocketmine\level\particle\AngryVillagerParticle;
use pocketmine\level\particle\BlockForceFieldParticle;
use pocketmine\level\particle\BubbleParticle;
use pocketmine\level\particle\CriticalParticle;
use pocketmine\level\particle\DestroyBlockParticle;
use pocketmine\level\particle\DustParticle;
use pocketmine\level\particle\EnchantmentTableParticle;
use pocketmine\level\particle\EnchantParticle;
use pocketmine\level\particle\EntityFlameParticle;
use pocketmine\level\particle\ExplodeParticle;
use pocketmine\level\particle\FlameParticle;
use pocketmine\level\particle\GenericParticle;
use pocketmine\level\particle\HappyVillagerParticle;
use pocketmine\level\particle\HeartParticle;
use pocketmine\level\particle\HugeExplodeParticle;
use pocketmine\level\particle\HugeExplodeSeedParticle;
use pocketmine\level\particle\InkParticle;
use pocketmine\level\particle\InstantEnchantParticle;
use pocketmine\level\particle\ItemBreakParticle;
use pocketmine\level\particle\LavaDripParticle;
use pocketmine\level\particle\LavaParticle;
use pocketmine\level\particle\MobSpawnParticle;
use pocketmine\level\particle\Particle;
use pocketmine\level\particle\PortalParticle;
use pocketmine\level\particle\RainSplashParticle;
use pocketmine\level\particle\RedstoneParticle;
use pocketmine\level\particle\SmokeParticle;
use pocketmine\level\particle\SnowballPoofParticle;
use pocketmine\level\particle\SplashParticle;
use pocketmine\level\particle\SporeParticle;
use pocketmine\level\particle\TerrainParticle;
use pocketmine\level\particle\WaterDripParticle;
use pocketmine\level\particle\WaterParticle;
use pocketmine\level\Position;
use pocketmine\math\Vector3;
use pocketmine\Player;
use pocketmine\plugin\PluginBase;
use pocketmine\utils\Config;
use TeleCash\TeleCash;
use UiLibrary\UiLibrary;


class ParticleManager extends PluginBase {

    private static $instance = null;
    public $pre = "§e•";
    public $time = [];
    public $mode = 0;

    //public $back = new Vector3();

    public static function getInstance() {
        return self::$instance;
    }

    public function onLoad() {
        self::$instance = $this;
    }

    public function onEnable() {
        $this->getServer()->getPluginManager()->registerEvents(new EventListener($this), $this);
        @mkdir($this->getDataFolder());
        $this->user = new Config($this->getDataFolder() . "user.yml", Config::YAML);
        $this->udata = $this->user->getAll();
        $this->cash = TeleCash::getInstance();
        $this->ui = UiLibrary::getInstance();
    }

    public function onDisable() {
        $this->save();
    }

    public function save() {
        $this->user->setAll($this->udata);
        $this->user->save();
    }

    public function onCommand(CommandSender $sender, Command $command, $label, $args): bool {
        if ($command->getName() == "테스트") {
            $this->mode = $args[0];
        }
        return true;
    }

    public function Normal(Position $player, int $particleId) { // 따라오는 파티클
        $particle = $this->getParticleToId($particleId);
        if ($player instanceof Player) {
            if (!isset($this->time[$player->getName()][$particleId]))
                $this->time[$player->getName()][$particleId] = microtime(true);
            if (microtime(true) - $this->time[$player->getName()][$particleId] <= 0.01)
                return false;
            $this->time[$player->getName()][$particleId] = microtime(true);
        }
        /*if($player instanceof Location)
          $player->getLevel()->addParticle(new $particle($this->Back($player)->add(0, 0.5, 0)));
        else
          $player->getLevel()->addParticle(new $particle($player));*/
        for ($y = 0.1; $y <= 0.6; $y += 0.25) {
            if ($player instanceof Location)
                $player->getLevel()->addParticle(new $particle($this->Back($player)->add(0, $y, 0)));
            else
                $player->getLevel()->addParticle(new $particle($player));
        }
    }

    public function getParticleToId(int $id) {
        switch ($id) {
            case 0:
                return "\pocketmine\level\particle\AngryVillagerParticle";
            case 1:
                return "\pocketmine\level\particle\BlockForceFieldParticle";
            case 2:
                return "\pocketmine\level\particle\BubbleParticle";
            case 3:
                return "\pocketmine\level\particle\CriticalParticle";
            case 4:
                return "\pocketmine\level\particle\DestroyBlockParticle";
            case 5:
                return "\pocketmine\level\particle\DustParticle";
            case 6:
                return "\pocketmine\level\particle\EnchantParticle";
            case 7:
                return "\pocketmine\level\particle\EnchantmentTableParticle";
            case 8:
                return "\pocketmine\level\particle\EntityFlameParticle";
            case 9:
                return "\pocketmine\level\particle\ExplodeParticle";
            case 10:
                return "\pocketmine\level\particle\FlameParticle";
            case 11:
                return "\pocketmine\level\particle\FloatingTextParticle";
            case 12:
                return "\pocketmine\level\particle\HappyVillagerParticle";
            case 13:
                return "\pocketmine\level\particle\HeartParticle";
            case 14:
                return "\pocketmine\level\particle\HugeExplodeParticle";
            case 15:
                return "\pocketmine\level\particle\HugeExplodeSeedParticle";
            case 16:
                return "\pocketmine\level\particle\InkParticle";
            case 17:
                return "\pocketmine\level\particle\InstantEnchantParticle";
            case 18:
                return "\pocketmine\level\particle\ItemBreakParticle";
            case 19:
                return "\pocketmine\level\particle\LavaDripParticle";
            case 20:
                return "\pocketmine\level\particle\LavaParticle";
            case 21:
                return "\pocketmine\level\particle\MobSpawnParticle";
            case 22:
                return "\pocketmine\level\particle\PortalParticle";
            case 23:
                return "\pocketmine\level\particle\RainSplashParticle";
            case 24:
                return "\pocketmine\level\particle\RedstoneParticle";
            case 25:
                return "\pocketmine\level\particle\SmokeParticle";
            case 26:
                return "\pocketmine\level\particle\SnowballPoofParticle";
            case 27:
                return "\pocketmine\level\particle\SplashParticle";
            case 28:
                return "\pocketmine\level\particle\SporeParticle";
            case 29:
                return "\pocketmine\level\particle\TerrainParticle";
            case 30:
                return "\pocketmine\level\particle\WaterDripParticle";
            case 31:
                return "\pocketmine\level\particle\WaterParticle";

            default:
                return null;
        }
    }

    public function Back(Location $player) {
        $y = -sin(deg2rad(0));
        $xz = cos(deg2rad(0));
        $x = -$xz * sin(deg2rad($player->yaw));
        $z = $xz * cos(deg2rad($player->yaw));
        $vec = (new Vector3())->setComponents($x, $y, $z)->normalize();
        return new Vector3($player->x + -$vec->x * 0.75, $player->y, $player->z + -$vec->z * 0.75);
    }

    public function Phrase(Position $player, int $particleId, int $r) { // 둘러싸는 파티클
        $particle = $this->getParticleToId($particleId);
        if ($player instanceof Player) {
            if (!isset($this->time[$player->getName()][$particleId]))
                $this->time[$player->getName()][$particleId] = microtime(true);
            if (microtime(true) - $this->time[$player->getName()][$particleId] <= 0.125)
                return false;
            $this->time[$player->getName()][$particleId] = microtime(true);
        }
        $y = 0.1;
        $diff = 5;
        for ($theta = 0; $theta <= 360; $theta += $diff) {
            if ($y >= 2)
                return false;
            $x = $r * sin($theta);
            $z = $r * cos($theta);
            $player->getLevel()->addParticle(new $particle($player->add($x, $y, $z)));
            $y += 0.025;
        }
    }

    public function Jump(Position $player) { // 점프파티클
        $player->getLevel()->addParticle(new HugeExplodeParticle($player->add(0, +0.5, 0)));
    }

    public function register(string $name) {
        $this->udata[mb_strtolower($name)]["목록"] = [];
        $this->udata[mb_strtolower($name)]["선택"] = -1;
    }

    public function ParticleUI(Player $player) {
        $form = $this->ui->SimpleForm(function (Player $player, array $data) {
            if (!isset($this->list[$player->getName()]) || !isset($data[0]))
                return false;
            $particleId = $this->list[$player->getName()];
            unset($this->list[$player->getName()]);
            if (!isset($particleId[$data[0]]))
                return false;
            $this->setSelectParticle($player->getName(), $particleId[$data[0]]);
            $this->ParticleUI($player);
        });
        $form->setTitle("Tele Particle");
        $text = "§l§c▶ §r§f구입하신 잔상효과가 등록됩니다.\n§l§6▶ §r§f한번에 한가지 잔상효과만 사용 가능합니다.";
        if (!$this->isRegistered($player->getName()) || count($this->getParticles($player->getName())) <= 0)
            $text .= "\n\n§l§c▶ §r§f구입하신 잔상 효과가 존재하지 않습니다.";
        else {
            $this->list[$player->getName()][0] = -1;
            $form->addButton("§l모든 잔상효과 취소");
            $count = 1;
            foreach ($this->getParticles($player->getName()) as $key => $particleId) {
                if ($particleId !== 14) {
                    $this->list[$player->getName()][$count] = $particleId;
                    $particleName = $this->getNameToId($particleId);
                    if ($this->getSelectParticle($player->getName()) == $particleId)
                        $form->addButton("§l이동시 {$particleName}\n§r§c선택됨");
                    else
                        $form->addButton("§l이동시 {$particleName}");
                    $count++;
                }
            }
            if ($this->hasParticle($player->getName(), 14))
                $form->addButton("§l§점프시 점프 잔상효과\n해당 효과는 항시 적용됩니다.");
        }
        $form->setContent($text);
        $form->sendToPlayer($player);
    }

    public function setSelectParticle(string $name, int $particleId) {
        if ($this->isRegistered($name)) {
            if ($particleId < 0)
                $this->udata[mb_strtolower($name)]["선택"] = -1;
            else
                $this->udata[mb_strtolower($name)]["선택"] = $particleId;
        }
    }

    public function isRegistered(string $name) {
        return isset($this->udata[mb_strtolower($name)]);
    }

    public function getParticles(string $name) {
        if (!$this->isRegistered($name))
            return null;
        return $this->udata[mb_strtolower($name)]["목록"];
    }

    public function getNameToId(int $id) {
        switch ($id) {
            case 0:
                return "화성암";
            case 1:
                return "?";
            case 2:
                return "방울";
            case 3:
                return "섬광";
            case 4:
                return "파괴";
            case 5:
                return "먼지";
            case 6:
                return "화염";
            case 7:
                return "고대 문자";
            case 8:
                return "?";
            case 9:
                return "소형 폭발";
            case 10:
                return "홍염";
            case 11:
                return "null";
            case 12:
                return "별빛";
            case 13:
                return "하트";
            case 14:
                return "중형 폭발";
            case 15:
                return "대형 폭발";
            case 16:
                return "잉크";
            case 17:
                return "?";
            case 18:
                return "?";
            case 19:
                return "소형 플레어";
            case 20:
                return "플레어";
            case 21:
                return "흰 먼지";
            case 22:
                return "포탈";
            case 23:
                return "빗물";
            case 24:
                return "레드스톤";
            case 25:
                return "회색 먼지";
            case 26:
                return "눈";
            case 27:
                return "스프린트";
            case 28:
                return "?";
            case 29:
                return "?";
            case 30:
                return "?";
            case 31:
                return "물";

            default:
                return null;
        }
    }

    public function getSelectParticle(string $name) {
        if (!$this->isRegistered($name))
            return null;
        return $this->udata[mb_strtolower($name)]["선택"];
    }

    public function hasParticle(string $name, int $particleId) {
        return in_array($particleId, $this->udata[mb_strtolower($name)]["목록"]);
    }

    public function checkShop(Player $player, int $particleId) {
        $this->list[$player->getName()] = $particleId;
        $form = $this->ui->ModalForm(function (Player $player, array $data) {
            $particleId = $this->list[$player->getName()];
            unset($this->list[$player->getName()]);
            $price = $this->getPrice($particleId);
            if ($data[0] == true) {
                if ($this->hasParticle($player->getName(), $particleId)) {
                    $player->sendMessage("{$this->pre} 이미 구입한 항목입니다.");
                    return false;
                } elseif ($price == null) {
                    $player->sendMessage("{$this->pre} 구입이 불가한 상품입니다.");
                    return false;
                } elseif ($price > $this->cash->getCash($player->getName())) {
                    $needCash = $price - $this->cash->getCash($player->getName());
                    $player->sendMessage("{$this->pre} 크레딧이 부족합니다. 필요 크레딧: {$needCash}");
                    return false;
                } else {
                    $this->cash->reduceCash($player->getName(), $price);
                    $this->addParticle($player->getName(), $particleId);
                    $player->sendMessage("{$this->pre} 정상적으로 구입하였습니다.");
                    $player->sendMessage("{$this->pre} 해당 효과는 메뉴 -> 프로필에서 설정하실 수 있습니다.");
                    return true;
                }
            } else {
                return false;
            }
        });
        $form->setTitle("Tele Particle");
        $form->setContent("§l§c▶ §r§f정말 해당 잔상을 구입하시겠습니까?\n  (보유 크레딧: {$this->cash->getCash($player->getName())}, 필요 크레딧: {$this->getPrice($particleId)})\n" . $this->getWarningMessage());
        $form->setButton1("§l[예]");
        $form->setButton2("§l[아니오]");
        $form->sendToPlayer($player);
    }

    public function getPrice(int $particleId) {
        switch ($particleId) {
            case 0: // 화난 주민
                return 65;

            case 7: // 인첸트 고대문자
                return 100;

            case 13: // 하트
                return 60;

            case 14: // 점프 파티클
                return 60;

            case 20: // 용암 불똥
                return 50;

            default:
                return null;
        }
    }

    public function addParticle(string $name, int $particleId) {
        $this->udata[mb_strtolower($name)]["목록"][] = $particleId;
    }

    public function getWarningMessage() {
        $text = "§l§c※ 주의사항\n";
        //$text .= "§l§c▶ §r§f크레딧으로 잔상 효과(파티클)를 구매할 수 있습니다.\n";
        $text .= "§l§6▶ §r§f각 효과마다 가격이 다르며,\n  크레딧으로 구매한 치장품은 무기한입니다.\n";
        $text .= "§l§e▶ §r§f한번 구매하면 프로필에 기록됩니다.\n";
        $text .= "§l§a▶ §r§f오류 등 불가피한 상황 외에는\n  환불이 불가능합니다.";
        return $text;
    }

    public function getIdToParticle(Particle $particle) {
        $particle = (new \ReflectionClass($particle))->getShortName();
        switch ($particle) {
            case "AngryVillagerParticle":
                return 0;
            case "BlockForceFieldParticle":
                return 1;
            case "BubbleParticle":
                return 2;
            case "CriticalParticle":
                return 3;
            case "DestroyBlockParticle":
                return 4;
            case "DustParticle":
                return 5;
            case "EnchantParticle":
                return 6;
            case "EnchantmentTableParticle":
                return 7;
            case "EntityFlameParticle":
                return 8;
            case "ExplodeParticle":
                return 9;
            case "FlameParticle":
                return 10;
            case "FloatingTextParticle":
                return 11;
            case "HappyVillagerParticle":
                return 12;
            case "HeartParticle":
                return 13;
            case "HugeExplodeParticle":
                return 14;
            case "HugeExplodeSeedParticle":
                return 15;
            case "InkParticle":
                return 16;
            case "InstantEnchantParticle":
                return 17;
            case "ItemBreakParticle":
                return 18;
            case "LavaDripParticle":
                return 19;
            case "LavaParticle":
                return 20;
            case "MobSpawnParticle":
                return 21;
            case "PortalParticle":
                return 22;
            case "RainSplashParticle":
                return 23;
            case "RedstoneParticle":
                return 24;
            case "SmokeParticle":
                return 25;
            case "SnowballPoofParticle":
                return 26;
            case "SplashParticle":
                return 27;
            case "SporeParticle":
                return 28;
            case "TerrainParticle":
                return 29;
            case "WaterDripParticle":
                return 30;
            case "WaterParticle":
                return 31;

            default:
                return null;
        }
    }
}
