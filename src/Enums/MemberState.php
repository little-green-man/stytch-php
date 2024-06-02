<?php

namespace LittleGreenMan\StytchPHP\Enums;

enum MemberState: string
{
    case Pending = 'pending';
    case Invited = 'invited';
    case Active = 'active';
    case Deleted = 'deleted';
}
// active: Members become active after successfully authenticating at least once via Stytch.
// When the SendLoginOrSignup endpoint is called on an active Member, they will receive a login
// email template. The Email Magic Link will route them to the login_redirect_url provided in the request.

// pending: Stytch Members are created as pending when created by the SendLoginOrSignup endpoint or when
// they are created by the CreateMember endpoint with the create_member_as_pending parameter set to true.
// If the SendInviteEmail endpoint is called on a pending Member, their status will change to invited.
// Once a Member successfully authenticates a Magic Link from either an invite or signup email, they will
// be marked as active.

// invited: Stytch Members are created as invited when created by the SendInviteEmail endpoint. The invited
// Member will receive an email that uses the invite email template. If the SendLoginOrSignup endpoint is
// called on an already invited member, their status will stay invited. Once a Member successfully authenticates
// a Magic Link from either an invite or signup email, they will be marked as active.

// deleted: Stytch Members are marked as deleted after calling the DeleteMember or DeleteOrganization endpoint.
// Once a Member is deleted, any emails or auth factors tied to that Member are also deleted. The SearchMember
// endpoint will not return deleted Members.
