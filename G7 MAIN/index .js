document.addEventListener('DOMContentLoaded', function() {
    const teamMembers = document.querySelectorAll('.team-members');
    teamMembers.forEach(member => {
        member.addEventListener('mouseenter', () => {
            member.style.borderColor = '#333';
            member.style.transform = 'scale(1.05)';

            const labelsAndText = member.querySelectorAll('p, .role-label, .contact-label, .bio-label');
            labelsAndText.forEach(element => {
                element.style.opacity = '1';
            });
        });
        member.addEventListener('mouseleave', () => {
            member.style.borderColor = 'transparent';
            member.style.transform = 'scale(1)';
            const labelsAndText = member.querySelectorAll('p, .role-label, .contact-label, .bio-label');
            labelsAndText.forEach(element => {
                element.style.opacity = '0';
            });
        });
    });
});
