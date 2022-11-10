<?php

function CalculateAngularVelocity($rpm) {
    return 2 * pi() * $rpm / 60; // rad/s - https://en.wikipedia.org/wiki/Radian
}

function CalculateTorque($power_watts, $rpm) {
    return $power_watts / CalculateAngularVelocity($rpm); // Nm - https://en.wikipedia.org/wiki/Newton-metre
}

// My motor and shaft can rotate at 5 rpm and has 4 Watts of power applied to it.
$power = 4; // Watts
$rpm = 5; // Revolutions per minute

// My weight is ~9.5 inches from the motor
$distance = 9.5; // inches
$distance = $distance * 0.0254; // convert to meters

// My weight is ~2.5 lbs
$weight = 2.5; // lbs
$weight = $weight * 0.453592; // convert to kg
$weight = $weight * 9.81; // convert to N

// My motor's angular velocity is:
$angular_velocity = CalculateAngularVelocity($rpm);
echo "My Angular Velocity is: " . $angular_velocity . " rad/s" . PHP_EOL;

// My motor's torque is:
$torque = CalculateTorque($power, $rpm);
echo "My Torque is: " . $torque . " Nm" . PHP_EOL;

// My load torque is:
$load_torque = $weight * $distance; // Nm
echo "My Load Torque is: " . $load_torque . " Nm" . PHP_EOL;

// Evaluate if my motor can handle the load torque
if ($load_torque > $torque) { 
    echo "My load is too heavy for my motor, it will stall." . PHP_EOL;
} else {
    echo "My load is not too heavy for my motor, it will not stall." . PHP_EOL;
}
